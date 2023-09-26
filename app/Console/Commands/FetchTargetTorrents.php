<?php

namespace App\Console\Commands;

use App\Models\DailyFoundTarget;
use App\Models\Target;
use App\Notifications\BaseNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use SimpleXMLElement;

class FetchTargetTorrents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:target-torrents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to fetch db target torrents';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (empty(config('config.ygg_url'))) {
            $this->error('Ygg URL not defined');
            return Command::FAILURE;
        }

        if (empty(config('config.ygg_id'))) {
            $this->error('Ygg ID not defined');
            return Command::FAILURE;
        }

        if (empty(config('config.ygg_key'))) {
            $this->error('Ygg KEY not defined');
            return Command::FAILURE;
        }

        $url = config('config.ygg_url')
            . '?action=generate&type=cat' . '&id=' . config('config.ygg_id')
            . '&passkey=' . config('config.ygg_key');

        $rss = Http::get($url);
        $xml = new SimpleXMLElement($rss);

        foreach ($xml->channel->item as $item) {

            $description = [];
            foreach (explode('<br/>', $item->description) as $row) {
                [$key, $val] = explode(':', $row, 2);
                $description[trim($key)] = trim($val);
            }

            $title = (array) $item->title;
            $link = (array) $item->link;
            $category = (array) $item->category;
            $pubDate = (array) $item->pubDate;
            $guid = (array) $item->guid;

            $items[] = [
                'title' => $title[0],
                'link' => $link[0],
                'category' => $category[0],
                'category_domain' => $category['@attributes']['domain'],
                'description' => $description,
                'guid' => $guid[0],
                'pubDate' => $pubDate[0],
            ];
        }

        $items = collect($items);

        Target::notFoundToday()->chunk(50, function ($targets) use ($items) {
            foreach ($targets as $target) {
                $result = $items->filter(function ($item) use ($target) {
                    return false !== stristr($item['title'], $target->name);
                })->first();

                if ($result) {
                    $dailyTarget = DailyFoundTarget::create([
                        'target_id' => $target->id,
                        'data' => $result,
                    ]);

                    $notifData = [
                        'subject' => "L'un de vos torrents est disponible.",
                        'message' => [
                            'Clique sur le lien ci-dessous pour aller sur le site et télécharger.',
                            'Tableau de bord: ' . new HtmlString('<a href="'. config('app.url') .'">Tableau de bord</a>')
                        ],
                    ];

                    $target->user->notify(new BaseNotification(['mail'], $notifData, ['text' => 'Consulter', 'url' => $result['guid']]));
                }
            }
        });

        return Command::SUCCESS;
    }
}

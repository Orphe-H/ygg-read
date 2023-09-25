<?php

namespace App\Console\Commands;

use App\Models\Target;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        //fetch ygg feed

        //TODO: check config is set

        $url = config('config.ygg_url')
            . '?action=generate&type=cat' . '&id=' . config('config.ygg_id')
            . '&passkey=' . config('config.ygg_key');

        $rss = Http::get($url);


        // use the link below

        Log::debug($rss);

        Target::chunk(50, function ($targets) {
            foreach ($targets as $target) {

            }
        });
    }
}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-4">
                {{ __('Welcome') . '! ' . auth()->user()->name }}
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($torrents as $torrent)
                    <div
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg hover:shadow-blue-200 hover:shadow-2xl sm:rounded-lg p-5 text-gray-900 dark:text-gray-100">
                        <div class="text-center font-bold text-lg text-blue-600 break-words">{{ $torrent->data['title'] }}</div>
                        <div class="text-center mt-2">
                            <a href="{{ $torrent->data['category_domain'] }}" target="_blank"
                                class="text-gray-500 dark:text-gray-400 hover:text-gray-800">
                                <span class="text-sm">{{ $torrent->data['category'] }}</span>
                            </a>
                        </div>
                        <div class="flex flex-wrap justify-between text-sm px-8 mt-9">
                            <div>Date de publication</div>
                            <div>{{ Carbon\Carbon::parse($torrent->data['pubDate'])->format('d-m-Y H:i') }}</div>
                        </div>
                        <div class="flex flex-wrap justify-between text-sm px-8 mt-2">
                            <div>Date d'enregistrement</div>
                            <div>{{ $torrent->created_at->format('d-m-Y H:i') }}</div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ $torrent->data['guid'] }}" target="_blank"
                                class="text-white bg-gray-800 hover:bg-gray-900 font-medium hover:font-semibold rounded px-2 py-1">
                                <span class="text-sm  ">Consulter</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $torrents->links() }}
        </div>
    </div>
</x-app-layout>

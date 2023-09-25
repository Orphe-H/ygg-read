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

            <div class="grid grid-cols-4 gap-4">
                @foreach ($torrents as $torrent)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5 text-gray-900 dark:text-gray-100">
                        {{ $torrent->id }}
                    </div>
                @endforeach
            </div>

            {{ $torrents->links() }}
        </div>
    </div>
</x-app-layout>

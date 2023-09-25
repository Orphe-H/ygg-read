
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Targets') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-4 flex flex-wrap justify-end">
                <a class="rounded-lg bg-blue-600 hover:bg-blue-700 px-3 py-1 text-white font-bold" href="{{ route('targets.create') }}">Ajouter</a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900 dark:text-gray-100">

                    <table class="w-full table-fixed">
                        <thead class="bg-slate-50">
                          <tr class="leading-8">
                            <th class="">#</th>
                            <th class="">{{ __('Name') }}</th>
                            <th class="">{{ __('Created at') }}</th>
                            <th>{{ __('Actions') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($targets as $target)
                                <tr class="leading-8">
                                    <td class="pl-2">{{ $target->id }}</td>
                                    <td class="pl-2">{{ $target->name }}</td>
                                    <td class="pl-2">{{ $target->created_at->format('d-m-Y à h:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $targets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($target->id ? 'Edit' : 'Add' . ' target') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-5 pb-3 px-20 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('targets.store') }}" method="post">
                        @csrf
                        <div class="flex justify-between items-center">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                            </div>
                            <div>
                                <x-text-input id="name" class="block w-full h-8 placeholder:text-slate-400" placeholder="Nom" type="text" name="name" :value="old('name', $target->name)" required autofocus autocomplete="name" />
                            </div>
                        </div>
                        <div class="mt-3 flex flex-wrap justify-end">
                            <button class="bg-blue-500 rounded-lg text-white font-medium px-2 py-1" type="submit">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

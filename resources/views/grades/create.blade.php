<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un Grade') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('grades.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="libelle" :value="__('Libellé')" />
                            <x-text-input id="libelle" class="block mt-1 w-full" type="text" name="libelle" :value="old('libelle')" required autofocus autocomplete="libelle" />
                            <x-input-error :messages="$errors->get('libelle')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="salaire_base" :value="__('Salaire Base')" />
                            <x-text-input id="salaire_base" class="block mt-1 w-full" type="number" step="0.01" name="salaire_base" :value="old('salaire_base')" autocomplete="salaire_base" />
                            <x-input-error :messages="$errors->get('salaire_base')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="description" rows="4">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('grades.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 underline">Annuler</a>
                            <x-primary-button>
                                {{ __('Créer') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

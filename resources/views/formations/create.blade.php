<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nouvelle Formation') }}
            </h2>
            <a href="{{ route('formations.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('formations.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required maxlength="255"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('titre') border-red-500 @enderror">
                            @error('titre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Date de début <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('date_debut') border-red-500 @enderror">
                                @error('date_debut')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Date de fin <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('date_fin') border-red-500 @enderror">
                                @error('date_fin')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="duree_heures" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Durée (heures)</label>
                                <input type="number" id="duree_heures" name="duree_heures" value="{{ old('duree_heures') }}" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('duree_heures') border-red-500 @enderror">
                                @error('duree_heures')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="formateur" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Formateur</label>
                                <input type="text" id="formateur" name="formateur" value="{{ old('formateur') }}" maxlength="255"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('formateur') border-red-500 @enderror">
                                @error('formateur')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="cout" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coût (€)</label>
                                <input type="number" id="cout" name="cout" value="{{ old('cout') }}" min="0" step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('cout') border-red-500 @enderror">
                                @error('cout')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <select id="statut" name="statut" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('statut') border-red-500 @enderror">
                                <option value="planifiee" {{ old('statut') == 'planifiee' ? 'selected' : '' }}>Planifiée</option>
                                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="terminee" {{ old('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                                <option value="annulee" {{ old('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            @error('statut')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('formations.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Créer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


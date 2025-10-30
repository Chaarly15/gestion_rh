<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nouvelle Absence') }}
            </h2>
            <a href="{{ route('absences.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('absences.store') }}" class="space-y-6">
                        @csrf

                        <!-- Employé -->
                        <div>
                            <label for="id_employe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Employé <span class="text-red-500">*</span>
                            </label>
                            <select name="id_employe" id="id_employe" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('id_employe') border-red-500 @enderror">
                                <option value="">Sélectionner un employé</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->id_employe }}" {{ old('id_employe') == $employe->id_employe ? 'selected' : '' }}>
                                        {{ $employe->matricule }} - {{ $employe->nom }} {{ $employe->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_employe')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date début -->
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Date Début <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('date_debut') border-red-500 @enderror">
                                @error('date_debut')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date fin -->
                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Date Fin <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('date_fin') border-red-500 @enderror">
                                @error('date_fin')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Motif -->
                        <div>
                            <label for="motif" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Motif <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="motif" id="motif" value="{{ old('motif') }}" required maxlength="255" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('motif') border-red-500 @enderror" placeholder="Ex: Maladie, Rendez-vous médical...">
                            @error('motif')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Commentaire -->
                        <div>
                            <label for="commentaire" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Commentaire
                            </label>
                            <textarea name="commentaire" id="commentaire" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('commentaire') border-red-500 @enderror" placeholder="Détails supplémentaires...">{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Informations -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                        Informations
                                    </h3>
                                    <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>Le statut sera automatiquement défini sur "En Attente"</li>
                                            <li>La durée sera calculée automatiquement</li>
                                            <li>La date de déclaration sera la date actuelle</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('absences.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


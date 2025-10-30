<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Modifier l\'Absence') }}
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
                    <form method="POST" action="{{ route('absences.update', $absence) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Employé -->
                        <div>
                            <label for="id_employe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Employé <span class="text-red-500">*</span>
                            </label>
                            <select name="id_employe" id="id_employe" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('id_employe') border-red-500 @enderror">
                                <option value="">Sélectionner un employé</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->id_employe }}" {{ (old('id_employe', $absence->id_employe) == $employe->id_employe) ? 'selected' : '' }}>
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
                                <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $absence->date_debut->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('date_debut') border-red-500 @enderror">
                                @error('date_debut')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date fin -->
                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Date Fin <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $absence->date_fin->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('date_fin') border-red-500 @enderror">
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
                            <input type="text" name="motif" id="motif" value="{{ old('motif', $absence->motif) }}" required maxlength="255" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('motif') border-red-500 @enderror">
                            @error('motif')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <select name="statut" id="statut" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('statut') border-red-500 @enderror">
                                <option value="en_attente" {{ old('statut', $absence->statut) == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                                <option value="justifiee" {{ old('statut', $absence->statut) == 'justifiee' ? 'selected' : '' }}>Justifiée</option>
                                <option value="non_justifiee" {{ old('statut', $absence->statut) == 'non_justifiee' ? 'selected' : '' }}>Non Justifiée</option>
                            </select>
                            @error('statut')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Commentaire -->
                        <div>
                            <label for="commentaire" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Commentaire
                            </label>
                            <textarea name="commentaire" id="commentaire" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('commentaire') border-red-500 @enderror">{{ old('commentaire', $absence->commentaire) }}</textarea>
                            @error('commentaire')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Informations -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">Date de déclaration:</span>
                                    <span class="text-gray-600 dark:text-gray-400 ml-2">{{ $absence->date_declaration->format('d/m/Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">Durée actuelle:</span>
                                    <span class="text-gray-600 dark:text-gray-400 ml-2">{{ $absence->jours_absence }} jour(s)</span>
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
                                Mettre à Jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


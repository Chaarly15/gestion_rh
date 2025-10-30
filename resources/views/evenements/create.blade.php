<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nouvel Événement') }}
            </h2>
            <a href="{{ route('evenements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                    <form method="POST" action="{{ route('evenements.store') }}" class="space-y-6">
                        @csrf

                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required maxlength="255" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('titre') border-red-500 @enderror" placeholder="Ex: Séminaire annuel, Team Building...">
                            @error('titre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type et Statut -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type -->
                            <div>
                                <label for="id_type_evenement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Type d'Événement <span class="text-red-500">*</span>
                                </label>
                                <select name="id_type_evenement" id="id_type_evenement" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('id_type_evenement') border-red-500 @enderror">
                                    <option value="">Sélectionner un type</option>
                                    @foreach($typeEvenements as $type)
                                        <option value="{{ $type->id_type_evenement }}" {{ old('id_type_evenement') == $type->id_type_evenement ? 'selected' : '' }}>
                                            {{ $type->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_type_evenement')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Statut -->
                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Statut <span class="text-red-500">*</span>
                                </label>
                                <select name="statut" id="statut" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('statut') border-red-500 @enderror">
                                    <option value="planifie" {{ old('statut', 'planifie') == 'planifie' ? 'selected' : '' }}>Planifié</option>
                                    <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                                    <option value="termine" {{ old('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                                    <option value="annule" {{ old('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>
                                </select>
                                @error('statut')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('description') border-red-500 @enderror" placeholder="Détails de l'événement...">{{ old('description') }}</textarea>
                            @error('description')
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

                        <!-- Heures -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Heure début -->
                            <div>
                                <label for="heure_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Heure Début
                                </label>
                                <input type="time" name="heure_debut" id="heure_debut" value="{{ old('heure_debut') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('heure_debut') border-red-500 @enderror">
                                @error('heure_debut')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Heure fin -->
                            <div>
                                <label for="heure_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Heure Fin
                                </label>
                                <input type="time" name="heure_fin" id="heure_fin" value="{{ old('heure_fin') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('heure_fin') border-red-500 @enderror">
                                @error('heure_fin')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lieu et Organisateur -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Lieu -->
                            <div>
                                <label for="lieu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Lieu
                                </label>
                                <input type="text" name="lieu" id="lieu" value="{{ old('lieu') }}" maxlength="255" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('lieu') border-red-500 @enderror" placeholder="Ex: Salle de conférence, Hôtel...">
                                @error('lieu')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Organisateur -->
                            <div>
                                <label for="organisateur_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Organisateur
                                </label>
                                <select name="organisateur_id" id="organisateur_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm @error('organisateur_id') border-red-500 @enderror">
                                    <option value="">Sélectionner un organisateur</option>
                                    @foreach($employes as $employe)
                                        <option value="{{ $employe->id_employe }}" {{ old('organisateur_id') == $employe->id_employe ? 'selected' : '' }}>
                                            {{ $employe->nom }} {{ $employe->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('organisateur_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('evenements.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Créer l'Événement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nouvelle Demande de Congé') }}
            </h2>
            <a href="{{ route('conges.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                    <form method="POST" action="{{ route('conges.store') }}" class="space-y-6">
                        @csrf

                        {{-- Employé --}}
                        <div>
                            <label for="id_employe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Employé <span class="text-red-500">*</span>
                            </label>
                            <select id="id_employe" name="id_employe" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('id_employe') border-red-500 @enderror">
                                <option value="">Sélectionnez un employé</option>
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

                        {{-- Type de congé --}}
                        <div>
                            <label for="id_type_conge" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Type de congé <span class="text-red-500">*</span>
                            </label>
                            <select id="id_type_conge" name="id_type_conge" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('id_type_conge') border-red-500 @enderror">
                                <option value="">Sélectionnez un type</option>
                                @foreach($typeConges as $type)
                                    <option value="{{ $type->id_type_conge }}" {{ old('id_type_conge') == $type->id_type_conge ? 'selected' : '' }}>
                                        {{ $type->libelle }}
                                        @if($type->jours_max)
                                            (Max: {{ $type->jours_max }} jours)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('id_type_conge')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dates --}}
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

                        {{-- Libellé --}}
                        <div>
                            <label for="libelle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Libellé
                            </label>
                            <input type="text" id="libelle" name="libelle" value="{{ old('libelle') }}" maxlength="255"
                                placeholder="Ex: Congés d'été"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('libelle') border-red-500 @enderror">
                            @error('libelle')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Motif --}}
                        <div>
                            <label for="motif" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Motif
                            </label>
                            <textarea id="motif" name="motif" rows="3"
                                placeholder="Décrivez le motif de votre demande..."
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('motif') border-red-500 @enderror">{{ old('motif') }}</textarea>
                            @error('motif')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Commentaire --}}
                        <div>
                            <label for="commentaire" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Commentaire
                            </label>
                            <textarea id="commentaire" name="commentaire" rows="3"
                                placeholder="Informations complémentaires..."
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('commentaire') border-red-500 @enderror">{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Boutons --}}
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('conges.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Créer la demande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


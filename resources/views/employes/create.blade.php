<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nouvel Employé') }}
            </h2>
            <a href="{{ route('employes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Erreur!</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('employes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Informations de base -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations de base</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <!-- Matricule -->
                                <div>
                                    <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule <span class="text-red-500">*</span></label>
                                    <input type="text" name="matricule" id="matricule" value="{{ old('matricule') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Nom -->
                                <div>
                                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom <span class="text-red-500">*</span></label>
                                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Prénom -->
                                <div>
                                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom <span class="text-red-500">*</span></label>
                                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Téléphone -->
                                <div>
                                    <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Poste -->
                                <div>
                                    <label for="poste" class="block text-sm font-medium text-gray-700">Poste</label>
                                    <input type="text" name="poste" id="poste" value="{{ old('poste') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Informations personnelles -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations personnelles</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <!-- Date de naissance -->
                                <div>
                                    <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                                    <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Lieu de naissance -->
                                <div>
                                    <label for="lieu_naissance" class="block text-sm font-medium text-gray-700">Lieu de naissance</label>
                                    <input type="text" name="lieu_naissance" id="lieu_naissance" value="{{ old('lieu_naissance') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Sexe -->
                                <div>
                                    <label for="sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                                    <select name="sexe" id="sexe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                </div>

                                <!-- Situation familiale -->
                                <div>
                                    <label for="situation_familiale" class="block text-sm font-medium text-gray-700">Situation familiale</label>
                                    <select name="situation_familiale" id="situation_familiale" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Sélectionner --</option>
                                        <option value="Célibataire" {{ old('situation_familiale') == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                        <option value="Marié(e)" {{ old('situation_familiale') == 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                                        <option value="Divorcé(e)" {{ old('situation_familiale') == 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                                        <option value="Veuf(ve)" {{ old('situation_familiale') == 'Veuf(ve)' ? 'selected' : '' }}>Veuf(ve)</option>
                                    </select>
                                </div>

                                <!-- Nombre d'enfants -->
                                <div>
                                    <label for="nombre_enfants" class="block text-sm font-medium text-gray-700">Nombre d'enfants</label>
                                    <input type="number" name="nombre_enfants" id="nombre_enfants" value="{{ old('nombre_enfants', 0) }}" min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Photo -->
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                                    <input type="file" name="photo" id="photo" accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Adresse</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Adresse -->
                                <div class="md:col-span-2">
                                    <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                                    <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Ville -->
                                <div>
                                    <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                                    <input type="text" name="ville" id="ville" value="{{ old('ville') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Code postal -->
                                <div>
                                    <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal</label>
                                    <input type="text" name="code_postal" id="code_postal" value="{{ old('code_postal') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Pays -->
                                <div>
                                    <label for="pays" class="block text-sm font-medium text-gray-700">Pays</label>
                                    <input type="text" name="pays" id="pays" value="{{ old('pays', 'France') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Informations professionnelles -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations professionnelles</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <!-- Direction -->
                                <div>
                                    <label for="id_direction" class="block text-sm font-medium text-gray-700">Direction <span class="text-red-500">*</span></label>
                                    <select name="id_direction" id="id_direction" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach($directions as $direction)
                                            <option value="{{ $direction->id_direction }}" {{ old('id_direction') == $direction->id_direction ? 'selected' : '' }}>
                                                {{ $direction->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Grade -->
                                <div>
                                    <label for="id_grade" class="block text-sm font-medium text-gray-700">Grade <span class="text-red-500">*</span></label>
                                    <select name="id_grade" id="id_grade" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id_grade }}" {{ old('id_grade') == $grade->id_grade ? 'selected' : '' }}>
                                                {{ $grade->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Profil -->
                                <div>
                                    <label for="id_profil_employe" class="block text-sm font-medium text-gray-700">Profil <span class="text-red-500">*</span></label>
                                    <select name="id_profil_employe" id="id_profil_employe" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach($profils as $profil)
                                            <option value="{{ $profil->id_profil_employe }}" {{ old('id_profil_employe') == $profil->id_profil_employe ? 'selected' : '' }}>
                                                {{ $profil->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Date d'embauche -->
                                <div>
                                    <label for="date_embauche" class="block text-sm font-medium text-gray-700">Date d'embauche <span class="text-red-500">*</span></label>
                                    <input type="date" name="date_embauche" id="date_embauche" value="{{ old('date_embauche') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Type de contrat -->
                                <div>
                                    <label for="type_contrat" class="block text-sm font-medium text-gray-700">Type de contrat <span class="text-red-500">*</span></label>
                                    <select name="type_contrat" id="type_contrat" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="CDI" {{ old('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI</option>
                                        <option value="CDD" {{ old('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD</option>
                                        <option value="Stage" {{ old('type_contrat') == 'Stage' ? 'selected' : '' }}>Stage</option>
                                        <option value="Alternance" {{ old('type_contrat') == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                                        <option value="Freelance" {{ old('type_contrat') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                    </select>
                                </div>

                                <!-- Date de fin de contrat -->
                                <div>
                                    <label for="date_fin_contrat" class="block text-sm font-medium text-gray-700">Date de fin de contrat</label>
                                    <input type="date" name="date_fin_contrat" id="date_fin_contrat" value="{{ old('date_fin_contrat') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Statut -->
                                <div>
                                    <label for="statut" class="block text-sm font-medium text-gray-700">Statut <span class="text-red-500">*</span></label>
                                    <select name="statut" id="statut" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="Actif" {{ old('statut') == 'Actif' ? 'selected' : '' }}>Actif</option>
                                        <option value="Inactif" {{ old('statut') == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                                        <option value="En congé" {{ old('statut') == 'En congé' ? 'selected' : '' }}>En congé</option>
                                        <option value="Suspendu" {{ old('statut') == 'Suspendu' ? 'selected' : '' }}>Suspendu</option>
                                    </select>
                                </div>

                                <!-- Salaire -->
                                <div>
                                    <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire (€)</label>
                                    <input type="number" name="salaire" id="salaire" value="{{ old('salaire') }}" step="0.01" min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- Disponibilité -->
                                <div class="flex items-center mt-6">
                                    <input type="checkbox" name="disponibilite" id="disponibilite" value="1" {{ old('disponibilite', true) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <label for="disponibilite" class="ml-2 block text-sm text-gray-700">Disponible</label>
                                </div>
                            </div>
                        </div>

                        <!-- Informations bancaires -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations bancaires et sécurité sociale</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <!-- Numéro de sécurité sociale -->
                                <div>
                                    <label for="numero_securite_sociale" class="block text-sm font-medium text-gray-700">N° Sécurité sociale</label>
                                    <input type="text" name="numero_securite_sociale" id="numero_securite_sociale" value="{{ old('numero_securite_sociale') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- IBAN -->
                                <div>
                                    <label for="iban" class="block text-sm font-medium text-gray-700">IBAN</label>
                                    <input type="text" name="iban" id="iban" value="{{ old('iban') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <!-- BIC -->
                                <div>
                                    <label for="bic" class="block text-sm font-medium text-gray-700">BIC</label>
                                    <input type="text" name="bic" id="bic" value="{{ old('bic') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-8">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('employes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Créer l'employé
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


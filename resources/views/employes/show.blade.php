<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profil de l\'employé') }} : {{ $employe->nom }} {{ $employe->prenom }}
            </h2>
            <div class="flex space-x-2">
                @can('update', $employe)
                    <a href="{{ route('employes.edit', $employe) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                @endcan
                <a href="{{ route('employes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- En-tête avec photo et infos principales -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                    <div class="flex items-center space-x-6">
                        @if($employe->photo)
                            <img src="{{ Storage::url($employe->photo) }}" alt="Photo de {{ $employe->nom }}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-32 h-32 rounded-full bg-white flex items-center justify-center border-4 border-white shadow-lg">
                                <span class="text-5xl font-bold text-indigo-600">{{ substr($employe->prenom, 0, 1) }}{{ substr($employe->nom, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-3xl font-bold">{{ $employe->nom }} {{ $employe->prenom }}</h3>
                            <p class="text-xl mt-2">{{ $employe->poste ?? 'Poste non défini' }}</p>
                            <div class="flex items-center space-x-4 mt-4">
                                <span class="px-3 py-1 bg-white text-indigo-600 rounded-full text-sm font-semibold">{{ $employe->matricule }}</span>
                                <span class="px-3 py-1 {{ $employe->statut == 'Actif' ? 'bg-green-500' : 'bg-red-500' }} text-white rounded-full text-sm font-semibold">{{ $employe->statut }}</span>
                                <span class="px-3 py-1 bg-white text-indigo-600 rounded-full text-sm font-semibold">{{ $employe->type_contrat }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Onglets -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 px-6" x-data="{ tab: 'infos' }">
                        <button @click="tab = 'infos'" :class="tab === 'infos' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Informations générales
                        </button>
                        <button @click="tab = 'conges'" :class="tab === 'conges' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Congés ({{ $employe->conges->count() }})
                        </button>
                        <button @click="tab = 'absences'" :class="tab === 'absences' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Absences ({{ $employe->absences->count() }})
                        </button>
                        <button @click="tab = 'formations'" :class="tab === 'formations' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Formations ({{ $employe->formations->count() }})
                        </button>
                        <button @click="tab = 'documents'" :class="tab === 'documents' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Documents ({{ $employe->documents->count() }})
                        </button>
                    </nav>
                </div>

                <div class="p-6">
                    <!-- Onglet Informations générales -->
                    <div x-show="tab === 'infos'" x-data="{ tab: 'infos' }">
                        
                        <!-- Informations de contact -->
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations de contact</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Téléphone</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->telephone ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Adresse</p>
                                    <p class="text-base font-medium text-gray-900">
                                        {{ $employe->adresse ?? 'Non renseignée' }}<br>
                                        @if($employe->code_postal || $employe->ville)
                                            {{ $employe->code_postal }} {{ $employe->ville }}<br>
                                        @endif
                                        {{ $employe->pays }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations personnelles -->
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations personnelles</h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">Date de naissance</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->date_naissance?->format('d/m/Y') ?? 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Lieu de naissance</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->lieu_naissance ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Sexe</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->sexe == 'M' ? 'Masculin' : ($employe->sexe == 'F' ? 'Féminin' : 'Non renseigné') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Âge</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->age ?? 'N/A' }} ans</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Situation familiale</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->situation_familiale ?? 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Nombre d'enfants</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->nombre_enfants ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations professionnelles -->
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations professionnelles</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">Direction</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->direction->nom ?? 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Grade</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->grade->libelle ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Profil</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->profil->nom ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date d'embauche</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->date_embauche?->format('d/m/Y') ?? 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Ancienneté</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->anciennete ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Type de contrat</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->type_contrat }}</p>
                                </div>
                                @if($employe->date_fin_contrat)
                                <div>
                                    <p class="text-sm text-gray-500">Date de fin de contrat</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->date_fin_contrat->format('d/m/Y') }}</p>
                                </div>
                                @endif
                                <div>
                                    <p class="text-sm text-gray-500">Salaire</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->salaire ? number_format($employe->salaire, 2, ',', ' ') . ' €' : 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Disponibilité</p>
                                    <p class="text-base font-medium text-gray-900">
                                        <span class="px-2 py-1 {{ $employe->disponibilite ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded text-sm">
                                            {{ $employe->disponibilite ? 'Disponible' : 'Non disponible' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations bancaires et sécurité sociale -->
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations bancaires et sécurité sociale</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">N° Sécurité sociale</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->numero_securite_sociale ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">IBAN</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->iban ?? 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">BIC</p>
                                    <p class="text-base font-medium text-gray-900">{{ $employe->bic ?? 'Non renseigné' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($employe->notes)
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Notes</h4>
                            <p class="text-base text-gray-700 whitespace-pre-line">{{ $employe->notes }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Onglet Congés -->
                    <div x-show="tab === 'conges'" x-data="{ tab: 'infos' }" style="display: none;">
                        @if($employe->conges->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date début</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date fin</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($employe->conges as $conge)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $conge->typeConge->nom ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $conge->date_debut?->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $conge->date_fin?->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $conge->duree }} jours</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $conge->statut == 'approuve' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $conge->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $conge->statut == 'rejete' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $conge->statut)) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Aucun congé enregistré</p>
                        @endif
                    </div>

                    <!-- Onglet Absences -->
                    <div x-show="tab === 'absences'" x-data="{ tab: 'infos' }" style="display: none;">
                        @if($employe->absences->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Justifiée</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($employe->absences as $absence)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absence->date_absence?->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $absence->motif }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $absence->justifiee ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $absence->justifiee ? 'Oui' : 'Non' }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Aucune absence enregistrée</p>
                        @endif
                    </div>

                    <!-- Onglet Formations -->
                    <div x-show="tab === 'formations'" x-data="{ tab: 'infos' }" style="display: none;">
                        @if($employe->formations->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($employe->formations as $formation)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">{{ $formation->titre }}</h5>
                                    <p class="text-sm text-gray-600 mb-2">{{ $formation->description }}</p>
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span>{{ $formation->date_debut?->format('d/m/Y') }} - {{ $formation->date_fin?->format('d/m/Y') }}</span>
                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-xs">{{ $formation->duree }}h</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Aucune formation enregistrée</p>
                        @endif
                    </div>

                    <!-- Onglet Documents -->
                    <div x-show="tab === 'documents'" x-data="{ tab: 'infos' }" style="display: none;">
                        @if($employe->documents->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'ajout</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($employe->documents as $document)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $document->nom }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $document->type }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $document->created_at->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ Storage::url($document->chemin) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Télécharger</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Aucun document enregistré</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


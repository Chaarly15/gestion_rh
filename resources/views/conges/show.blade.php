<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Détails du Congé') }}
            </h2>
            <div class="flex gap-2">
                @can('update', $conge)
                    <a href="{{ route('conges.edit', $conge) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier
                    </a>
                @endcan
                <a href="{{ route('conges.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Messages --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Informations principales --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $conge->libelle ?? 'Demande de congé' }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Créé le {{ $conge->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'en_attente' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'approuve' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    'rejete' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'annule' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
                                ];
                                $statusLabels = [
                                    'en_attente' => 'En attente',
                                    'approuve' => 'Approuvé',
                                    'rejete' => 'Rejeté',
                                    'annule' => 'Annulé',
                                ];
                            @endphp
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusColors[$conge->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $statusLabels[$conge->statut] ?? $conge->statut }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Employé --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Employé</h4>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($conge->employe->photo)
                                        <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $conge->employe->photo) }}" alt="{{ $conge->employe->nom }}">
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-indigo-600 flex items-center justify-center">
                                            <span class="text-xl font-medium text-white">{{ substr($conge->employe->prenom, 0, 1) }}{{ substr($conge->employe->nom, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ $conge->employe->nom }} {{ $conge->employe->prenom }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $conge->employe->matricule }} - {{ $conge->employe->poste }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Type de congé --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Type de congé</h4>
                            <p class="text-lg text-gray-900 dark:text-gray-100">{{ $conge->typeConge->libelle }}</p>
                            @if($conge->typeConge->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $conge->typeConge->description }}</p>
                            @endif
                        </div>

                        {{-- Période --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Période</h4>
                            <p class="text-lg text-gray-900 dark:text-gray-100">
                                Du {{ $conge->date_debut->format('d/m/Y') }} au {{ $conge->date_fin->format('d/m/Y') }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Durée: <span class="font-semibold">{{ $conge->duree }} jour(s)</span>
                            </p>
                        </div>

                        {{-- Valideur --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Validation</h4>
                            @if($conge->valideur)
                                <p class="text-lg text-gray-900 dark:text-gray-100">
                                    {{ $conge->valideur->nom }} {{ $conge->valideur->prenom }}
                                </p>
                                @if($conge->date_validation)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        Le {{ $conge->date_validation->format('d/m/Y à H:i') }}
                                    </p>
                                @endif
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400">En attente de validation</p>
                            @endif
                        </div>
                    </div>

                    {{-- Motif --}}
                    @if($conge->motif)
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Motif</h4>
                            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-line">{{ $conge->motif }}</p>
                        </div>
                    @endif

                    {{-- Commentaire --}}
                    @if($conge->commentaire)
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Commentaire</h4>
                            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-line">{{ $conge->commentaire }}</p>
                        </div>
                    @endif

                    {{-- Motif de rejet --}}
                    @if($conge->statut === 'rejete' && $conge->motif_rejet)
                        <div class="mt-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <h4 class="text-sm font-medium text-red-800 dark:text-red-200 mb-2">Motif du rejet</h4>
                            <p class="text-red-700 dark:text-red-300 whitespace-pre-line">{{ $conge->motif_rejet }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Pièces justificatives --}}
            @if($conge->piecesJustificatives && $conge->piecesJustificatives->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Pièces justificatives ({{ $conge->piecesJustificatives->count() }})
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($conge->piecesJustificatives as $document)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                {{ $document->nom }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $document->type_document }}
                                            </p>
                                        </div>
                                        <a href="{{ asset('storage/' . $document->chemin) }}" target="_blank" class="ml-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Actions --}}
            @if($conge->statut === 'en_attente')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Actions</h3>
                        <div class="flex gap-4">
                            <form action="{{ route('conges.approuver', $conge) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approuver
                                </button>
                            </form>

                            <button type="button" onclick="document.getElementById('reject-modal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Rejeter
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal de rejet --}}
    <div id="reject-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Rejeter la demande</h3>
                <form action="{{ route('conges.rejeter', $conge) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="motif_rejet" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Motif du rejet <span class="text-red-500">*</span>
                        </label>
                        <textarea id="motif_rejet" name="motif_rejet" rows="4" required
                            placeholder="Expliquez la raison du rejet..."
                            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Confirmer le rejet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


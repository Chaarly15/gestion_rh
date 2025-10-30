<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Détails de l\'Absence') }}
            </h2>
            <div class="flex space-x-2">
                @can('update', $absence)
                <a href="{{ route('absences.edit', $absence) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Modifier
                </a>
                @endcan
                <a href="{{ route('absences.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informations principales -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Carte principale -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Informations de l'Absence
                                </h3>
                                @if($absence->statut === 'en_attente')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        En Attente
                                    </span>
                                @elseif($absence->statut === 'justifiee')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Justifiée
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Non Justifiée
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <!-- Période -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date Début</label>
                                        <p class="mt-1 text-base text-gray-900 dark:text-gray-100">{{ $absence->date_debut->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date Fin</label>
                                        <p class="mt-1 text-base text-gray-900 dark:text-gray-100">{{ $absence->date_fin->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <!-- Durée -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Durée</label>
                                    <p class="mt-1 text-base text-gray-900 dark:text-gray-100">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $absence->jours_absence }} jour(s)
                                        </span>
                                    </p>
                                </div>

                                <!-- Motif -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Motif</label>
                                    <p class="mt-1 text-base text-gray-900 dark:text-gray-100">{{ $absence->motif }}</p>
                                </div>

                                <!-- Commentaire -->
                                @if($absence->commentaire)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Commentaire</label>
                                    <p class="mt-1 text-base text-gray-900 dark:text-gray-100">{{ $absence->commentaire }}</p>
                                </div>
                                @endif

                                <!-- Date de déclaration -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date de Déclaration</label>
                                    <p class="mt-1 text-base text-gray-900 dark:text-gray-100">{{ $absence->date_declaration->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pièces justificatives -->
                    @if($absence->piecesJustificatives->count() > 0)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                Pièces Justificatives ({{ $absence->piecesJustificatives->count() }})
                            </h3>
                            <div class="space-y-3">
                                @foreach($absence->piecesJustificatives as $piece)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $piece->nom_fichier }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $piece->type_document }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($piece->chemin_fichier) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Employé -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Employé</h3>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                        <span class="text-indigo-600 dark:text-indigo-300 font-medium text-lg">
                                            {{ substr($absence->employe->nom, 0, 1) }}{{ substr($absence->employe->prenom, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">
                                        {{ $absence->employe->nom }} {{ $absence->employe->prenom }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $absence->employe->matricule }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $absence->employe->email }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('employes.show', $absence->employe) }}" class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Voir le profil →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    @if($absence->statut === 'en_attente')
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Actions</h3>
                            <div class="space-y-3">
                                <!-- Approuver -->
                                <form action="{{ route('absences.approuver', $absence) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Justifier
                                    </button>
                                </form>

                                <!-- Rejeter -->
                                <form action="{{ route('absences.rejeter', $absence) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir marquer cette absence comme non justifiée ?');">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Non Justifiée
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Statistiques -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Statistiques</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Total absences (employé)</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $absence->employe->absences->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Jours d'absence (total)</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $absence->employe->absences->sum('jours_absence') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


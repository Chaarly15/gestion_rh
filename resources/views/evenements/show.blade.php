<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Détails de l\'Événement') }}
            </h2>
            <div class="flex space-x-2">
                @can('update', $evenement)
                <a href="{{ route('evenements.edit', $evenement) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Modifier
                </a>
                @endcan
                <a href="{{ route('evenements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $evenement->titre }}
                                </h3>
                                @if($evenement->statut === 'planifie')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Planifié
                                    </span>
                                @elseif($evenement->statut === 'en_cours')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        En Cours
                                    </span>
                                @elseif($evenement->statut === 'termine')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                        Terminé
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Annulé
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <!-- Type -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Type d'Événement</label>
                                    <p class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                            {{ $evenement->typeEvenement->nom }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Description -->
                                @if($evenement->description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Description</label>
                                    <p class="mt-1 text-base text-gray-900 dark:text-gray-100">{{ $evenement->description }}</p>
                                </div>
                                @endif

                                <!-- Période -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date Début</label>
                                        <p class="mt-1 text-base text-gray-900 dark:text-gray-100">
                                            {{ $evenement->date_debut->format('d/m/Y') }}
                                            @if($evenement->heure_debut)
                                                <span class="text-sm text-gray-500">à {{ $evenement->heure_debut->format('H:i') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date Fin</label>
                                        <p class="mt-1 text-base text-gray-900 dark:text-gray-100">
                                            {{ $evenement->date_fin->format('d/m/Y') }}
                                            @if($evenement->heure_fin)
                                                <span class="text-sm text-gray-500">à {{ $evenement->heure_fin->format('H:i') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Lieu -->
                                @if($evenement->lieu)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Lieu</label>
                                    <p class="mt-1 text-base text-gray-900 dark:text-gray-100 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $evenement->lieu }}
                                    </p>
                                </div>
                                @endif

                                <!-- Organisateur -->
                                @if($evenement->organisateur)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Organisateur</label>
                                    <div class="mt-2 flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                                <span class="text-indigo-600 dark:text-indigo-300 font-medium text-sm">
                                                    {{ substr($evenement->organisateur->nom, 0, 1) }}{{ substr($evenement->organisateur->prenom, 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $evenement->organisateur->nom }} {{ $evenement->organisateur->prenom }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $evenement->organisateur->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Liste des participants -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                Participants ({{ $evenement->participants->count() }})
                            </h3>

                            @if($evenement->participants->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Employé</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Commentaire</th>
                                            <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($evenement->participants as $participant)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                                            <span class="text-indigo-600 dark:text-indigo-300 font-medium text-xs">
                                                                {{ substr($participant->nom, 0, 1) }}{{ substr($participant->prenom, 0, 1) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            {{ $participant->nom }} {{ $participant->prenom }}
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $participant->matricule }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                @if($participant->pivot->statut_participation === 'invite')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                        Invité
                                                    </span>
                                                @elseif($participant->pivot->statut_participation === 'confirme')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        Confirmé
                                                    </span>
                                                @elseif($participant->pivot->statut_participation === 'present')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Présent
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        Absent
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $participant->pivot->commentaire ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                @can('update', $evenement)
                                                <form action="{{ route('evenements.participants.remove', [$evenement, $participant]) }}" method="POST" class="inline" onsubmit="return confirm('Retirer ce participant ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                Aucun participant pour le moment.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Ajouter un participant -->
                    @can('update', $evenement)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Ajouter un Participant</h3>
                            <form action="{{ route('evenements.participants.add', $evenement) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="id_employe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employé</label>
                                    <select name="id_employe" id="id_employe" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                                        <option value="">Sélectionner</option>
                                        @foreach(\App\Models\Employe::where('statut', 'Actif')->orderBy('nom')->get() as $employe)
                                            @if(!$evenement->participants->contains($employe->id_employe))
                                            <option value="{{ $employe->id_employe }}">
                                                {{ $employe->nom }} {{ $employe->prenom }}
                                            </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="statut_participation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statut</label>
                                    <select name="statut_participation" id="statut_participation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                                        <option value="invite">Invité</option>
                                        <option value="confirme">Confirmé</option>
                                        <option value="present">Présent</option>
                                        <option value="absent">Absent</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Ajouter
                                </button>
                            </form>
                        </div>
                    </div>
                    @endcan

                    <!-- Statistiques -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Statistiques</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Total participants</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $evenement->participants->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Confirmés</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $evenement->participants->where('pivot.statut_participation', 'confirme')->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Présents</span>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $evenement->participants->where('pivot.statut_participation', 'present')->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


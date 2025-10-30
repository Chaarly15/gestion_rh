<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Gestion des Employés') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Gérez et suivez tous vos employés
                </p>
            </div>
            @can('create', App\Models\Employe::class)
                <a href="{{ route('employes.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-semibold text-sm text-white shadow-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajouter un Employé
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-6 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages de succès/erreur --}}
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-l-4 border-green-500 px-6 py-4 rounded-xl shadow-md" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 border-l-4 border-red-500 px-6 py-4 rounded-xl shadow-md" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- Filtres et Recherche --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl mb-6 border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-500 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            Filtres et Recherche
                        </h3>
                    </div>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('employes.index') }}" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            {{-- Recherche --}}
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Rechercher
                                </label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Nom, prénom, email, matricule, poste..."
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            </div>

                            {{-- Filtre Direction --}}
                            <div>
                                <label for="direction" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Direction</label>
                                <select name="direction" id="direction" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Toutes</option>
                                    @foreach($directions as $direction)
                                        <option value="{{ $direction->id }}" {{ request('direction') == $direction->id ? 'selected' : '' }}>
                                            {{ $direction->nom_direction }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filtre Grade --}}
                            <div>
                                <label for="grade" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Grade</label>
                                <select name="grade" id="grade" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Tous</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" {{ request('grade') == $grade->id ? 'selected' : '' }}>
                                            {{ $grade->nom_grade }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filtre Profil --}}
                            <div>
                                <label for="profil" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Profil</label>
                                <select name="profil" id="profil" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Tous</option>
                                    @foreach($profils as $profil)
                                        <option value="{{ $profil->id }}" {{ request('profil') == $profil->id ? 'selected' : '' }}>
                                            {{ $profil->nom_profil }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filtre Statut --}}
                            <div>
                                <label for="statut" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Statut</label>
                                <select name="statut" id="statut" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Tous</option>
                                    <option value="Actif" {{ request('statut') == 'Actif' ? 'selected' : '' }}>Actif</option>
                                    <option value="Inactif" {{ request('statut') == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                                    <option value="En congé" {{ request('statut') == 'En congé' ? 'selected' : '' }}>En congé</option>
                                    <option value="Suspendu" {{ request('statut') == 'Suspendu' ? 'selected' : '' }}>Suspendu</option>
                                </select>
                            </div>

                            {{-- Filtre Type de Contrat --}}
                            <div>
                                <label for="type_contrat" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Type de Contrat</label>
                                <select name="type_contrat" id="type_contrat" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Tous</option>
                                    <option value="CDI" {{ request('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI</option>
                                    <option value="CDD" {{ request('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD</option>
                                    <option value="Stage" {{ request('type_contrat') == 'Stage' ? 'selected' : '' }}>Stage</option>
                                    <option value="Alternance" {{ request('type_contrat') == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                                    <option value="Freelance" {{ request('type_contrat') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-2">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-md hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Rechercher
                                </button>
                                <a href="{{ route('employes.index') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-300 shadow-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Réinitialiser
                                </a>
                            </div>

                            @can('export', App\Models\Employe::class)
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('employes.export.excel') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-md hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Excel
                                    </a>
                                    <a href="{{ route('employes.export.pdf') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-pink-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-md hover:from-red-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        PDF
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tableau des Employés --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    Liste des Employés
                                </h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ $employes->total() }} employé(s) au total</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Employé</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Matricule</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Poste</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Direction</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($employes as $employe)
                                <tr class="hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($employe->photo)
                                                <img src="{{ asset('storage/' . $employe->photo) }}" alt="{{ $employe->nom }}" class="h-12 w-12 rounded-full object-cover ring-2 ring-white dark:ring-gray-700">
                                            @else
                                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-white dark:ring-gray-700">
                                                    {{ strtoupper(substr($employe->prenom ?? 'N', 0, 1)) }}{{ strtoupper(substr($employe->nom ?? 'A', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $employe->nom }} {{ $employe->prenom }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $employe->type_contrat ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                            {{ $employe->matricule }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                        {{ $employe->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                        {{ $employe->poste ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                        {{ $employe->direction->nom_direction ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($employe->statut == 'Actif')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-700">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Actif
                                            </span>
                                        @elseif($employe->statut == 'En congé')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-700">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                                En congé
                                            </span>
                                        @elseif($employe->statut == 'Inactif')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                Inactif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-700">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                                </svg>
                                                Suspendu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            @can('view', $employe)
                                                <a href="{{ route('employes.show', $employe) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-800 rounded-lg text-xs font-medium transition-colors">
                                                    Voir
                                                </a>
                                            @endcan
                                            @can('update', $employe)
                                                <a href="{{ route('employes.edit', $employe) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-800 rounded-lg text-xs font-medium transition-colors">
                                                    Modifier
                                                </a>
                                            @endcan
                                            @can('delete', $employe)
                                                <form action="{{ route('employes.destroy', $employe) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-800 rounded-lg text-xs font-medium transition-colors">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Aucun employé trouvé.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    {{ $employes->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>


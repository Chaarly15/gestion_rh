@extends('layouts.app')

@section('page-title', 'Tableau de bord')

@section('content')

<div class="space-y-8">
    <!-- Cards section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                {{-- Total Employés --}}
                <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Total Employés</p>
                                <p class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_employes'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Personnel total</p>
                            </div>
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-indigo-500 to-indigo-600"></div>
                </div>

                {{-- Employés Actifs --}}
                <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Employés Actifs</p>
                                <p class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['employes_actifs'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">En activité</p>
                            </div>
                            <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-green-500 to-green-600"></div>
                </div>

                {{-- Employés en Congé --}}
                <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">En Congé</p>
                                <p class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['employes_en_conge'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Absents</p>
                            </div>
                            <div class="flex-shrink-0 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-yellow-500 to-yellow-600"></div>
                </div>

                {{-- Total Directions --}}
                <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-lg hover:shadow-2xl sm:rounded-2xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">Directions</p>
                                <p class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_directions'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Départements</p>
                            </div>
                            <div class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-purple-500 to-purple-600"></div>
                </div>
            </div>

            {{-- Statistiques des congés --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 overflow-hidden shadow-md hover:shadow-xl sm:rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 border-l-4 border-orange-500">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-orange-500 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">En Attente</p>
                        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $congesStats['en_attente'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 overflow-hidden shadow-md hover:shadow-xl sm:rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 border-l-4 border-green-500">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-green-500 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">Approuvés</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $congesStats['approuves'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 overflow-hidden shadow-md hover:shadow-xl sm:rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 border-l-4 border-blue-500">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-500 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">En Cours</p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $congesStats['en_cours'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 overflow-hidden shadow-md hover:shadow-xl sm:rounded-xl p-5 transition-all duration-300 hover:-translate-y-1 border-l-4 border-red-500">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-red-500 rounded-full mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">Refusés</p>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $congesStats['refuses'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                {{-- Employés par Direction --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                Employés par Direction
                            </h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($employesParDirection ?? [] as $direction)
                                <div class="group p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate mr-2">{{ $direction->nom_direction }}</span>
                                        <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 min-w-[2rem] text-right">{{ $direction->employes_count }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                                        @php
                                            $totalEmployes = $stats['total_employes'] ?? 1;
                                            $percentage = $totalEmployes > 0 ? ($direction->employes_count / $totalEmployes) * 100 : 0;
                                        @endphp
                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2.5 rounded-full transition-all duration-500 group-hover:from-indigo-600 group-hover:to-purple-700" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($percentage, 1) }}% du total</p>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aucune donnée disponible</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Employés par Type de Contrat --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                Répartition par Type de Contrat
                            </h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($employesParContrat ?? [] as $contrat)
                                <div class="group p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate mr-2">{{ $contrat->type_contrat }}</span>
                                        <span class="text-sm font-bold text-green-600 dark:text-green-400 min-w-[2rem] text-right">{{ $contrat->total }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                                        @php
                                            $totalEmployes = $stats['total_employes'] ?? 1;
                                            $percentage = $totalEmployes > 0 ? ($contrat->total / $totalEmployes) * 100 : 0;
                                        @endphp
                                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2.5 rounded-full transition-all duration-500 group-hover:from-green-600 group-hover:to-emerald-700" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($percentage, 1) }}% du total</p>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aucune donnée disponible</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Congés en attente (Admin/RH uniquement) --}}
            @if(auth()->user()->hasRole(['Administrateur', 'RH']))
                @if(isset($congesEnAttente) && $congesEnAttente->count() > 0)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl mb-8 border border-gray-100 dark:border-gray-700">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-orange-500 rounded-lg">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            Congés en Attente de Validation
                                        </h3>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">{{ $congesEnAttente->count() }} demande(s) à traiter</p>
                                    </div>
                                </div>
                                <a href="{{ route('conges.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                                    Voir tout
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Employé</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Période</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Durée</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($congesEnAttente as $conge)
                                        <tr class="hover:bg-orange-50 dark:hover:bg-orange-900/10 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 font-semibold text-xs">
                                                        {{ strtoupper(substr($conge->employe->prenom ?? 'N', 0, 1)) }}{{ strtoupper(substr($conge->employe->nom ?? 'A', 0, 1)) }}
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            {{ $conge->employe->nom ?? 'N/A' }} {{ $conge->employe->prenom ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                    {{ $conge->typeConge->nom_type_conge ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                                    {{ $conge->nombre_jours }} jour(s)
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <a href="{{ route('conges.show', $conge) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-800 rounded-lg font-medium transition-colors">
                                                    Voir
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                {{-- Derniers Employés --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-blue-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    Derniers Employés Ajoutés
                                </h3>
                            </div>
                            <a href="{{ route('employes.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition-colors">
                                Voir tout
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @forelse($derniersEmployes ?? [] as $employe)
                                <div class="group flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-700 rounded-xl hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 transition-all duration-300 border border-gray-200 dark:border-gray-600 hover:border-indigo-300 dark:hover:border-indigo-600 hover:shadow-md">
                                    <div class="flex items-center min-w-0 flex-1">
                                        @if($employe->photo)
                                            <img src="{{ asset('storage/' . $employe->photo) }}" alt="{{ $employe->nom }}" class="h-12 w-12 rounded-full object-cover flex-shrink-0 ring-2 ring-white dark:ring-gray-700 group-hover:ring-indigo-300 dark:group-hover:ring-indigo-600 transition-all">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 ring-2 ring-white dark:ring-gray-700 group-hover:ring-indigo-300 dark:group-hover:ring-indigo-600 transition-all">
                                                {{ strtoupper(substr($employe->prenom ?? 'N', 0, 1)) }}{{ strtoupper(substr($employe->nom ?? 'A', 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="ml-4 min-w-0 flex-1">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                {{ $employe->nom ?? 'N/A' }} {{ $employe->prenom ?? '' }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">
                                                {{ $employe->poste ?? 'N/A' }}
                                            </p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 truncate">
                                                {{ $employe->direction->nom_direction ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('employes.show', $employe) }}" class="ml-3 inline-flex items-center px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-800 rounded-lg text-xs font-medium transition-colors flex-shrink-0">
                                        Voir
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aucun employé récent</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Prochains Événements --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-purple-500 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    Prochains Événements
                                </h3>
                            </div>
                            <a href="{{ route('evenements.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition-colors">
                                Voir tout
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @forelse($prochainsEvenements ?? [] as $evenement)
                                <div class="group flex items-start p-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-700 rounded-xl hover:from-purple-50 hover:to-pink-50 dark:hover:from-purple-900/20 dark:hover:to-pink-900/20 transition-all duration-300 border border-gray-200 dark:border-gray-600 hover:border-purple-300 dark:hover:border-purple-600 hover:shadow-md">
                                    <div class="flex-shrink-0">
                                        <div class="h-14 w-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex flex-col items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <span class="text-xs text-white font-bold uppercase">{{ \Carbon\Carbon::parse($evenement->date_evenement)->format('M') }}</span>
                                            <span class="text-xl text-white font-bold">{{ \Carbon\Carbon::parse($evenement->date_evenement)->format('d') }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                            {{ $evenement->titre }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-1">
                                            {{ $evenement->typeEvenement->nom_type_evenement ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($evenement->date_evenement)->format('d/m/Y à H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aucun événement à venir</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Anniversaires et Formations --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Anniversaires du Mois --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                🎂 Anniversaires du Mois
                            </h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @forelse($anniversaires ?? [] as $employe)
                                <div class="group flex items-center justify-between p-4 bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-xl hover:from-yellow-100 hover:to-orange-100 dark:hover:from-yellow-900/30 dark:hover:to-orange-900/30 transition-all duration-300 border border-yellow-200 dark:border-yellow-700 hover:shadow-md">
                                    <div class="flex items-center min-w-0 flex-1">
                                        @if($employe->photo)
                                            <img src="{{ asset('storage/' . $employe->photo) }}" alt="{{ $employe->nom }}" class="h-12 w-12 rounded-full object-cover flex-shrink-0 ring-2 ring-yellow-300 dark:ring-yellow-600 group-hover:ring-4 transition-all">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 ring-2 ring-yellow-300 dark:ring-yellow-600 group-hover:ring-4 transition-all">
                                                {{ strtoupper(substr($employe->prenom ?? 'N', 0, 1)) }}{{ strtoupper(substr($employe->nom ?? 'A', 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="ml-4 min-w-0 flex-1">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                                {{ $employe->nom ?? 'N/A' }} {{ $employe->prenom ?? '' }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">
                                                📅 {{ \Carbon\Carbon::parse($employe->date_naissance)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="ml-3 text-2xl animate-bounce">
                                            🎉
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <div class="text-6xl mb-4">🎂</div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Aucun anniversaire ce mois-ci</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Formations en Cours --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    Formations en Cours
                                </h3>
                            </div>
                            <a href="{{ route('formations.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium transition-colors">
                                Voir tout
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @forelse($formationsEnCours ?? [] as $formation)
                                <div class="group p-4 bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 rounded-xl hover:from-cyan-100 hover:to-blue-100 dark:hover:from-cyan-900/30 dark:hover:to-blue-900/30 transition-all duration-300 border border-cyan-200 dark:border-cyan-700 hover:shadow-md">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0 p-2 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                                {{ $formation->titre }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                📅 Du {{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}
                                                au {{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}
                                            </p>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-cyan-100 to-blue-100 dark:from-cyan-900 dark:to-blue-900 text-cyan-800 dark:text-cyan-200 border border-cyan-300 dark:border-cyan-700">
                                                    {{ $formation->statut }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aucune formation en cours</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

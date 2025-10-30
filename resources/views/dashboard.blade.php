@extends('layouts.app')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Bienvenue, {{ auth()->user()->name }} 👋</h2>
                <p class="text-gray-300">Voici un aperçu de votre système RH aujourd'hui</p>
            </div>
            <div class="hidden md:block text-6xl opacity-20">📊</div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Employés Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Employés</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_employes'] ?? 0 }}</h3>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $stats['employes_actifs'] ?? 0 }} actifs
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                        <span class="text-2xl">👥</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="{{ route('employes.index') }}" class="text-sm font-medium text-blue-600 hover:text-gray-900 transition-colors">
                    Voir tous les employés →
                </a>
            </div>
        </div>

        <!-- Absences Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Absences</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_absences'] ?? 0 }}</h3>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-800">
                            Aujourd'hui
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center text-white">
                        <span class="text-2xl">⏰</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="{{ route('absences.index') }}" class="text-sm font-medium text-blue-600 hover:text-gray-900 transition-colors">
                    Gérer les absences →
                </a>
            </div>
        </div>

        <!-- Congés Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Demandes de Congés</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $congesStats['en_attente'] ?? 0 }}</h3>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            En attente
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                        <span class="text-2xl">📅</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="{{ route('conges.index') }}" class="text-sm font-medium text-blue-600 hover:text-gray-900 transition-colors">
                    Traiter les demandes →
                </a>
            </div>
        </div>

        <!-- Directions Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 mb-1">Directions</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_directions'] ?? 0 }}</h3>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-800">
                            Départements
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center text-white">
                        <span class="text-2xl">🏢</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="{{ route('directions.index') }}" class="text-sm font-medium text-blue-600 hover:text-gray-900 transition-colors">
                    Voir les directions →
                </a>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Chart - Larger -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Employés par Direction</h3>
                    <p class="text-sm text-gray-600 mt-1">Répartition du personnel</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-gray-900 transition-colors">
                        Ce mois
                    </button>
                </div>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="employesChart"></canvas>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistiques Rapides</h3>
            <div class="space-y-4">
                <!-- Taux de présence -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Taux de présence</span>
                        <span class="text-sm font-bold text-gray-900">
                            {{ $stats['total_employes'] > 0 ? round((($stats['total_employes'] - ($stats['total_absences'] ?? 0)) / $stats['total_employes']) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500"
                             style="width: {{ $stats['total_employes'] > 0 ? round((($stats['total_employes'] - ($stats['total_absences'] ?? 0)) / $stats['total_employes']) * 100, 1) : 0 }}%"></div>
                    </div>
                </div>

                <!-- Congés approuvés -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Congés approuvés</span>
                        <span class="text-sm font-bold text-gray-900">{{ $congesStats['approuves'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gray-900 h-2.5 rounded-full transition-all duration-500"
                             style="width: {{ ($congesStats['total'] ?? 0) > 0 ? round((($congesStats['approuves'] ?? 0) / ($congesStats['total'] ?? 1)) * 100) : 0 }}%"></div>
                    </div>
                </div>

                <!-- Formations en cours -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-600">Formations actives</span>
                        <span class="text-sm font-bold text-gray-900">{{ $stats['formations_actives'] ?? 0 }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: 65%"></div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <h4 class="text-xs font-semibold text-gray-600 uppercase tracking-wider mb-3">Actions rapides</h4>
                    <div class="space-y-2">
                        <a href="{{ route('employes.create') }}" class="block w-full px-4 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-gray-900 transition-colors">
                            + Nouvel employé
                        </a>
                        <a href="{{ route('conges.create') }}" class="block w-full px-4 py-2 text-sm font-medium text-center text-white bg-gray-900 rounded-lg hover:bg-blue-600 transition-colors">
                            + Nouvelle demande
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Feed & Upcoming Events -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900">Activités Récentes</h3>
                <span class="text-sm text-gray-600">Dernières 24h</span>
            </div>
            <div class="space-y-4">
                @forelse($derniersEmployes ?? [] as $employe)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border-l-4 border-blue-600">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-lg">✅</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">
                            Nouvel employé ajouté
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            <strong>{{ $employe->nom }} {{ $employe->prenom }}</strong>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ $employe->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                @endforelse

                @foreach(($congesEnAttente ?? collect())->take(3) as $conge)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border-l-4 border-gray-900">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <span class="text-lg">📅</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">
                            Demande de congé
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            <strong>{{ $conge->employe->nom ?? 'N/A' }} {{ $conge->employe->prenom ?? '' }}</strong>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ $conge->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach

                @if(($derniersEmployes ?? collect())->isEmpty() && ($congesEnAttente ?? collect())->isEmpty())
                <div class="text-center py-8">
                    <span class="text-4xl mb-2 block">📭</span>
                    <p class="text-sm text-gray-500">Aucune activité récente</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900">Événements à Venir</h3>
                <a href="{{ route('evenements.index') }}" class="text-sm font-medium text-blue-600 hover:text-gray-900 transition-colors">
                    Voir tout
                </a>
            </div>
            <div class="space-y-4">
                @forelse(($prochainsEvenements ?? collect())->take(5) as $evenement)
                <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border-l-4 border-blue-500">
                    <div class="flex-shrink-0">
                        <div class="text-center">
                            <div class="text-xs font-semibold text-gray-500 uppercase">
                                {{ \Carbon\Carbon::parse($evenement->date_evenement)->format('M') }}
                            </div>
                            <div class="text-2xl font-bold text-gray-900">
                                {{ \Carbon\Carbon::parse($evenement->date_evenement)->format('d') }}
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 mb-1">
                            {{ $evenement->titre }}
                        </p>
                        @if($evenement->description)
                        <p class="text-xs text-gray-600 line-clamp-2">
                            {{ $evenement->description }}
                        </p>
                        @endif
                        <div class="flex items-center mt-2 space-x-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                🎉 Événement
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <span class="text-4xl mb-2 block">📆</span>
                    <p class="text-sm text-gray-500">Aucun événement prévu</p>
                    <a href="{{ route('evenements.create') }}" class="inline-block mt-3 text-sm font-medium text-blue-600 hover:text-blue-700">
                        Créer un événement →
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('employesChart');
    if (!ctx) return;

    const employesParDirection = @json($employesParDirection ?? []);
    const labels = employesParDirection.map(d => d.nom_direction);
    const data = employesParDirection.map(d => d.employes_count);

    // Couleurs charte graphique: Bleu, Blanc et Noir
    const colors = [
        'rgba(37, 99, 235, 0.9)',    // blue-600
        'rgba(17, 24, 39, 0.9)',     // gray-900 (noir)
        'rgba(59, 130, 246, 0.9)',   // blue-500
        'rgba(55, 65, 81, 0.9)',     // gray-700
        'rgba(96, 165, 250, 0.9)',   // blue-400
        'rgba(31, 41, 55, 0.9)',     // gray-800
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.length > 0 ? labels : ['Direction A', 'Direction B', 'Direction C', 'Direction D'],
            datasets: [{
                label: 'Nombre d\'employés',
                data: data.length > 0 ? data : [45, 32, 28, 19],
                backgroundColor: colors,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                    padding: 12,
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#2563eb',
                    borderWidth: 2,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' employé(s)';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6B7280',
                        font: {
                            size: 12
                        },
                        precision: 0
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#6B7280',
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
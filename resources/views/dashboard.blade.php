@extends('layouts.app')

@section('header', 'Tableau de bord')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="bg-white rounded-lg p-8 shadow-sm border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Bonjour, {{ auth()->user()->name }}</h2>
        <p class="text-gray-600">Voici un aperçu de votre système RH</p>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Employés Card -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-blue-500 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">👥</span>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">Total Employés</p>
            <h3 class="text-3xl font-semibold text-gray-900">{{ $stats['total_employes'] ?? 0 }}</h3>
            <p class="text-sm text-green-600 mt-2">{{ $stats['employes_actifs'] ?? 0 }} actifs</p>
        </div>

        <!-- Absences Card -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-blue-500 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">⏰</span>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">Absences</p>
            <h3 class="text-3xl font-semibold text-gray-900">{{ $stats['total_absences'] ?? 0 }}</h3>
            <p class="text-sm text-gray-500 mt-2">Aujourd'hui</p>
        </div>

        <!-- Congés Card -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-blue-500 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">📅</span>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">Demandes de Congés</p>
            <h3 class="text-3xl font-semibold text-gray-900">{{ $congesStats['en_attente'] ?? 0 }}</h3>
            <p class="text-sm text-yellow-600 mt-2">En attente</p>
        </div>

        <!-- Directions Card -->
        <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-blue-500 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">🏢</span>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">Directions</p>
            <h3 class="text-3xl font-semibold text-gray-900">{{ $stats['total_directions'] ?? 0 }}</h3>
            <p class="text-sm text-gray-500 mt-2">Départements</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Chart - Larger -->
        <div class="lg:col-span-2 bg-white rounded-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Employés par Direction</h3>
            <div class="relative" style="height: 300px;">
                <canvas id="employesChart"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
            <div class="space-y-3">
                <a href="{{ route('employes.create') }}" class="block w-full px-4 py-3 text-sm font-medium text-center text-white bg-blue-500 hover:bg-blue-600 rounded-lg transition-colors">
                    + Nouvel employé
                </a>
                <a href="{{ route('conges.create') }}" class="block w-full px-4 py-3 text-sm font-medium text-center text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    + Nouvelle demande
                </a>
                <a href="{{ route('absences.create') }}" class="block w-full px-4 py-3 text-sm font-medium text-center text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    + Nouvelle absence
                </a>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Statistiques</h4>
                <div class="space-y-3">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-600">Taux de présence</span>
                            <span class="text-sm font-semibold text-gray-900">
                                {{ $stats['total_employes'] > 0 ? round((($stats['total_employes'] - ($stats['total_absences'] ?? 0)) / $stats['total_employes']) * 100, 1) : 0 }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['total_employes'] > 0 ? round((($stats['total_employes'] - ($stats['total_absences'] ?? 0)) / $stats['total_employes']) * 100, 1) : 0 }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-600">Congés approuvés</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $congesStats['approuves'] ?? 0 }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ ($congesStats['total'] ?? 0) > 0 ? round((($congesStats['approuves'] ?? 0) / ($congesStats['total'] ?? 1)) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white rounded-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Activités Récentes</h3>
            <div class="space-y-4">
            <div class="space-y-3">
                @forelse($derniersEmployes ?? [] as $employe)
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-lg">👤</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $employe->nom }} {{ $employe->prenom }}</p>
                        <p class="text-xs text-gray-600 mt-1">Nouvel employé</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $employe->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-4">Aucune activité récente</p>
                @endforelse

                @foreach(($congesEnAttente ?? collect())->take(2) as $conge)
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                            <span class="text-lg">📅</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $conge->employe->nom ?? 'N/A' }} {{ $conge->employe->prenom ?? '' }}</p>
                        <p class="text-xs text-gray-600 mt-1">Demande de congé</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $conge->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>

                @if(($derniersEmployes ?? collect())->isEmpty() && ($congesEnAttente ?? collect())->isEmpty())
                <div class="text-center py-8">
                    <span class="text-4xl mb-2 block">📭</span>
                    <p class="text-sm text-gray-500">Aucune activité récente</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-lg p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Événements à Venir</h3>
                <a href="{{ route('evenements.index') }}" class="text-sm font-medium text-blue-500 hover:text-blue-600">
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

    // Couleurs minimalistes
    const colors = [
        'rgba(59, 130, 246, 0.8)',   // blue-500
        'rgba(147, 197, 253, 0.8)',  // blue-300
        'rgba(96, 165, 250, 0.8)',   // blue-400
        'rgba(37, 99, 235, 0.8)',    // blue-600
        'rgba(191, 219, 254, 0.8)',  // blue-200
        'rgba(29, 78, 216, 0.8)',    // blue-700
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
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    cornerRadius: 6,
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
                            size: 11
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
                        color: '#374151',
                        font: {
                            size: 11
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
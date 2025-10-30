<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestion RH') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <!-- Sidebar Desktop - 25% -->
        <aside class="w-1/4 bg-gradient-to-b from-blue-700 to-blue-500 text-white shadow-xl min-h-screen block">
            <div class="flex flex-col h-screen sticky top-0">

            <!-- Logo / Brand -->
            <div class="p-6 border-b border-blue-600">
                <h1 class="text-2xl font-bold text-center">Gestion RH</h1>
                <p class="text-xs text-center text-blue-200 mt-1">Système de gestion</p>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-blue-600">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-blue-200 truncate">
                            {{ auth()->user()->roles->first()?->name ?? 'Utilisateur' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2 flex-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 shadow-lg' : 'hover:bg-blue-600' }}">
                    <span class="text-xl">🏠</span>
                    <span class="font-medium">Tableau de bord</span>
                </a>

                @can('viewAny', App\Models\Employe::class)
                <a href="{{ route('employes.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('employes.*') ? 'bg-blue-600 shadow-lg' : 'hover:bg-blue-600' }}">
                    <span class="text-xl">👥</span>
                    <span class="font-medium">Employés</span>
                </a>
                @endcan

                @can('viewAny', App\Models\Conge::class)
                <a href="{{ route('conges.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('conges.*') ? 'bg-blue-600 shadow-lg' : 'hover:bg-blue-600' }}">
                    <span class="text-xl">📅</span>
                    <span class="font-medium">Congés</span>
                </a>
                @endcan

                @can('viewAny', App\Models\Absence::class)
                <a href="{{ route('absences.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('absences.*') ? 'bg-blue-600 shadow-lg' : 'hover:bg-blue-600' }}">
                    <span class="text-xl">⏰</span>
                    <span class="font-medium">Absences</span>
                </a>
                @endcan

                @can('viewAny', App\Models\Formation::class)
                <a href="{{ route('formations.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('formations.*') ? 'bg-blue-600 shadow-lg' : 'hover:bg-blue-600' }}">
                    <span class="text-xl">📚</span>
                    <span class="font-medium">Formations</span>
                </a>
                @endcan

                @can('viewAny', App\Models\Evenement::class)
                <a href="{{ route('evenements.index') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('evenements.*') ? 'bg-blue-600 shadow-lg' : 'hover:bg-blue-600' }}">
                    <span class="text-xl">🎉</span>
                    <span class="font-medium">Événements</span>
                </a>
                @endcan

                <!-- Divider -->
                <div class="border-t border-blue-600 my-4"></div>

                <!-- Settings Section -->
                <div class="space-y-2">
                    <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider">Paramètres</p>

                    @can('viewAny', App\Models\Direction::class)
                    <a href="{{ route('directions.index') }}"
                       class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors text-sm {{ request()->routeIs('directions.*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                        <span>🏢</span>
                        <span>Directions</span>
                    </a>
                    @endcan

                    @can('viewAny', App\Models\Grade::class)
                    <a href="{{ route('grades.index') }}"
                       class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors text-sm {{ request()->routeIs('grades.*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                        <span>⭐</span>
                        <span>Grades</span>
                    </a>
                    @endcan

                    @can('viewAny', App\Models\Profil::class)
                    <a href="{{ route('profils.index') }}"
                       class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors text-sm {{ request()->routeIs('profils.*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                        <span>👤</span>
                        <span>Profils</span>
                    </a>
                    @endcan
                </div>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-blue-600">
                <livewire:layout.sidebar-user />
            </div>
            </div>
        </aside>


        <!-- Main Content - 75% -->
        <div class="w-3/4 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex justify-between items-center px-6 py-4">
                    <!-- Page Title -->
                    <h1 class="text-xl font-semibold text-gray-700">
                        @yield('page-title', 'Tableau de bord')
                    </h1>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-500 hover:text-blue-600 transition-colors">
                            <span class="text-2xl">🔔</span>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Dropdown -->
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff"
                                 class="w-10 h-10 rounded-full border-2 border-blue-500"
                                 alt="{{ auth()->user()->name }}">
                            <div class="hidden md:block">
                                <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->roles->first()?->name ?? 'Utilisateur' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1">
                @if (isset($header))
                    <div class="mb-6">
                        {{ $header }}
                    </div>
                @endif

                @yield('content')
                {{ $slot ?? '' }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} Gestion RH. Tous droits réservés.</p>
                    <p class="mt-2 md:mt-0">Version 1.0.0</p>
                </div>
            </footer>
        </div>
    </div>

    @livewireScripts

    <!-- Close sidebar on link click (mobile) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('aside a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        Alpine.store('sidebarOpen', false);
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails du Type de Congé') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Informations du Type de Congé</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $typeConge->id_type_conge }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Libellé</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-semibold">{{ $typeConge->libelle }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de jours maximum</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    @if($typeConge->jours_max)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $typeConge->jours_max }} jours
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Illimité
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de création</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $typeConge->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $typeConge->description ?? 'Aucune description' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($typeConge->conges->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium mb-4">Congés associés ({{ $typeConge->conges->count() }})</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white dark:bg-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Employé</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date début</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date fin</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($typeConge->conges->take(10) as $conge)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $conge->id_conge }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $conge->employe->nom_complet ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    @php
                                                        $statusColors = [
                                                            'en_attente' => 'bg-yellow-100 text-yellow-800',
                                                            'approuve' => 'bg-green-100 text-green-800',
                                                            'rejete' => 'bg-red-100 text-red-800',
                                                            'annule' => 'bg-gray-100 text-gray-800',
                                                        ];
                                                        $statusLabels = [
                                                            'en_attente' => 'En attente',
                                                            'approuve' => 'Approuvé',
                                                            'rejete' => 'Rejeté',
                                                            'annule' => 'Annulé',
                                                        ];
                                                    @endphp
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$conge->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                                        {{ $statusLabels[$conge->statut] ?? $conge->statut }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($typeConge->conges->count() > 10)
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Affichage de 10 congés sur {{ $typeConge->conges->count() }}
                                </p>
                            @endif
                        </div>
                    @else
                        <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Aucun congé associé à ce type pour le moment.</p>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('type-conges.index') }}" class="text-gray-600 dark:text-gray-400 underline">
                            Retour à la liste
                        </a>
                        <div class="flex space-x-2">
                            <a href="{{ route('type-conges.edit', $typeConge) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('type-conges.destroy', $typeConge) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de congé ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

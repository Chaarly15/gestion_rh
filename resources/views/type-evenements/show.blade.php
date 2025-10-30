<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails du Type d\'Événement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Informations du Type d'Événement</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $typeEvenement->id_type_evenement }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-semibold">{{ $typeEvenement->nom }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de création</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $typeEvenement->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dernière modification</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $typeEvenement->updated_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $typeEvenement->description ?? 'Aucune description' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($typeEvenement->evenements->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium mb-4">Événements associés ({{ $typeEvenement->evenements->count() }})</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white dark:bg-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Titre</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date début</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date fin</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Organisateur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($typeEvenement->evenements->take(10) as $evenement)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $evenement->id_evenement }}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $evenement->titre }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ \Carbon\Carbon::parse($evenement->date_debut)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ \Carbon\Carbon::parse($evenement->date_fin)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $evenement->organisateur->nom_complet ?? 'N/A' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($typeEvenement->evenements->count() > 10)
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Affichage de 10 événements sur {{ $typeEvenement->evenements->count() }}
                                </p>
                            @endif
                        </div>
                    @else
                        <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Aucun événement associé à ce type pour le moment.</p>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('type-evenements.index') }}" class="text-gray-600 dark:text-gray-400 underline">
                            Retour à la liste
                        </a>
                        <div class="flex space-x-2">
                            <a href="{{ route('type-evenements.edit', $typeEvenement) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('type-evenements.destroy', $typeEvenement) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'événement ?')">
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

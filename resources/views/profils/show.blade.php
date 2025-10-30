<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails du Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Profil: {{ $profil->nom }}</h3>
                        <div>
                            <a href="{{ route('profils.edit', $profil) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>
                            <a href="{{ route('profils.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Retour</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <strong>ID:</strong> {{ $profil->id_profil_employe }}
                        </div>
                        <div>
                            <strong>Nom:</strong> {{ $profil->nom }}
                        </div>
                        <div class="md:col-span-2">
                            <strong>Description:</strong> {{ $profil->description ?: 'Aucune description' }}
                        </div>
                        <div>
                            <strong>Créé le:</strong> {{ $profil->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div>
                            <strong>Mis à jour le:</strong> {{ $profil->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-md font-medium mb-4">Employés avec ce profil</h4>
                        @if($profil->employes->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white dark:bg-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prénom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Direction</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($profil->employes as $employe)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $employe->nom }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $employe->prenom }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $employe->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $employe->direction->nom }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">Aucun employé avec ce profil.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

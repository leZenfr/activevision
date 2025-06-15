<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'Utilisateur AD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Informations de l'utilisateur</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Informations générales (à gauche) -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow col-span-2 md:col-span-1">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Informations générales</h4>
                            <p><strong>SID :</strong> <span class="text-gray-700">{{ $objectUser->objectSid }}</span></p>
                            <p><strong>Nom :</strong> <span class="text-gray-700">{{ $objectUser->displayName }}</span></p>
                            <p><strong>Email :</strong> <span class="text-gray-700">{{ $objectUser->userPrincipalName }}</span></p>
                            <p><strong>Nom SAM :</strong> <span class="text-gray-700">{{ $objectUser->sAMAccountName }}</span></p>
                            <p><strong>Titre :</strong> <span class="text-gray-700">{{ $objectUser->title }}</span></p>
                            <p><strong>Code Postal :</strong> <span class="text-gray-700">{{ $objectUser->postalCode }}</span></p>
                            <p><strong>Adresse :</strong> <span class="text-gray-700">{{ $objectUser->streetAddress }}</span></p>
                            <p><strong>Entreprise :</strong> <span class="text-gray-700">{{ $objectUser->company }}</span></p>
                            <p><strong>Manager :</strong> <span class="text-gray-700">{{ $objectUser->manager }}</span></p>
                        </div>

                        <!-- Informations sur les mots de passe (en haut à droite) -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Informations sur les mots de passe</h4>
                            <p><strong>Dernière tentative de mot de passe incorrect :</strong> <span class="text-gray-700">{{ $objectUser->badPasswordTime ? $objectUser->badPasswordTime->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Dernière connexion :</strong> <span class="text-gray-700">{{ $objectUser->lastLogon ? $objectUser->lastLogon->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Verrouillage :</strong> <span class="text-gray-700">{{ $objectUser->lockoutTime ? $objectUser->lockoutTime->format('d/m/Y H:i') : 'Aucun' }}</span></p>
                        </div>

                        <!-- Gestion du compte (en bas à droite) -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800">Gestion du compte</h4>
                            <p><strong>Expiration du compte :</strong> <span class="text-gray-700">{{ $objectUser->accountExpires ? $objectUser->accountExpires->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Dernière modification :</strong> <span class="text-gray-700">{{ $objectUser->whenChanged ? $objectUser->whenChanged->format('d/m/Y H:i') : 'Jamais' }}</span></p>
                            <p><strong>Date de création :</strong> <span class="text-gray-700">{{ $objectUser->whenCreated ? $objectUser->whenCreated->format('d/m/Y H:i') : 'Inconnue' }}</span></p>
                            <p><strong>Contrôle du compte utilisateur :</strong> <span class="text-gray-700">{{ $objectUser->userAccountControl ? 'Activé' : 'Désactivé' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-gray-100 p-4 rounded-lg"></div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Événements</h3>

                    <!-- Filtres -->
                    <form method="GET" action="{{ route('objectusers.show', $objectUser->objectSid) }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Filtre par date -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm w-full">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm w-full">
                            </div>

                            <!-- Filtre par type d'événement
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type d'événement</label>
                                <div class="flex items-center space-x-6">
                                    <label class="flex items-center space-x-2 text-sm text-gray-600 hover:text-indigo-600">
                                        <input type="checkbox" name="event_types[]" value="user_data" {{ in_array('user_data', request('event_types', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span>Données utilisateur</span>
                                    </label>
                                    <label class="flex items-center space-x-2 text-sm text-gray-600 hover:text-indigo-600">
                                        <input type="checkbox" name="event_types[]" value="password" {{ in_array('password', request('event_types', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span>Mot de passe</span>
                                    </label>
                                    <label class="flex items-center space-x-2 text-sm text-gray-600 hover:text-indigo-600">
                                        <input type="checkbox" name="event_types[]" value="account_management" {{ in_array('account_management', request('event_types', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span>Gestion de compte</span>
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Filtrer</button>
                        </div>
                    </form>

                    <!-- Graphique -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow mt-6">
                        <h4 class="text-lg font-semibold mb-4 text-gray-800">Timeline des événements</h4>
                        <canvas id="eventsChart" class="w-full h-64"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('eventsChart').getContext('2d');

                            const eventDates = @json($eventDates); // Les dates des événements
                            const eventTitles = @json($eventTitles); // Les titres des événements

                            const data = {
                                labels: eventDates, // Les dates sur l'axe X
                                datasets: [{
                                    label: 'Événements',
                                    data: eventDates.map(() => 1), // Une valeur constante pour chaque événement
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    pointStyle: 'circle',
                                    pointRadius: 6,
                                    pointHoverRadius: 8,
                                    pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Couleur des "pins"
                                }]
                            };

                            const config = {
                                type: 'line', // Type de graphique
                                data: data,
                                options: {
                                    responsive: true,
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function (context) {
                                                    return eventTitles[context.dataIndex]; // Affiche le titre de l'événement au survol
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Dates'
                                            }
                                        },
                                        y: {
                                            display: false // Cache l'axe Y car il n'est pas nécessaire
                                        }
                                    }
                                }
                            };

                            new Chart(ctx, config);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
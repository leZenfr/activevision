<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Groupe AD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-indigo-600">Informations du groupe</h3>

                    <ul class="list-disc pl-5 mb-6">
                        <li><strong>SID :</strong> {{ $objectGroup->objectSid }}</li>
                        <li><strong>DN :</strong> {{ $objectGroup->distinguishedName ?? 'Non spécifié' }}</li>
                        <li><strong>Dernière modification :</strong> {{ $objectGroup->whenChanged ? $objectGroup->whenChanged->format('d/m/Y H:i') : 'Jamais' }}</li>
                        <li><strong>Date de création :</strong> {{ $objectGroup->whenCreated ? $objectGroup->whenCreated->format('d/m/Y H:i') : 'Inconnue' }}</li>
                    </ul>

                    <h3 class="text-xl font-bold mb-4 text-indigo-600">Membres du groupe</h3>

                    @if ($objectGroup->member)
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nom du membre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (explode(',', $objectGroup->member) as $member)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $member }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600">Aucun membre trouvé dans ce groupe.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
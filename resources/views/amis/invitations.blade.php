<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Invitations d’amis
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto space-y-6">

        @forelse($invitations as $invitation)
            <div id="invite-{{ $invitation->id }}"
                 class="bg-white p-5 rounded-xl shadow flex items-center justify-between">

                <div class="flex items-center gap-4">
                    <img
                        src="{{ $invitation->expediteur->photo
                                ? asset('storage/'.$invitation->expediteur->photo)
                                : 'https://ui-avatars.com/api/?name='.urlencode($invitation->expediteur->nom) }}"
                        class="w-12 h-12 rounded-full object-cover"
                    >

                    <div>
                        <p class="font-bold">{{ $invitation->expediteur->nom }}</p>
                        <p class="text-sm text-gray-500">
                            {{ ucfirst($invitation->expediteur->role) }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button
                         data-invitation-id="{{ $invitation->id }}"
    onclick="respondInvitation(this.getAttribute('data-invitation-id'), 'accept')"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                    >
                        ✅ Accepter
                    </button>

                    <button
                    data-invitation-id="{{ $invitation->id }}"
                          onclick="respondInvitation(this.getAttribute('data-invitation-id'), 'reject')"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                    >
                        ❌ Refuser
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">
                Aucune invitation pour le moment.
            </div>
        @endforelse

    </div>
</x-app-layout>
<script src="./ajax.js"></script>
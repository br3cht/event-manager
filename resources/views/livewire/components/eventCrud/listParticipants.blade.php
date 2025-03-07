<div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
        <button wire:click="closeInscriptions()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-xl font-semibold mb-4">Lista de Usuários</h2>

        <ul class="space-y-2">
            @foreach($participants as $participant)
                <li class="p-2 bg-gray-100 rounded-md flex justify-between items-center">
                    <span>{{ $participant->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
        <h2 class="text-lg font-semibold mb-4">Inscrever-se no Evento</h2>
        <p class="text-gray-600 mb-4">Tem certeza de que deseja se inscrever neste evento?</p>
        <div class="flex justify-end">
            <button wire:click.prevent="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
            <button wire:click="subscribe()" class="bg-blue-500 text-white px-4 py-2 rounded">Inscrever-se</button>
        </div>
    </div>
</div>

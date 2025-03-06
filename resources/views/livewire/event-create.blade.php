<div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl p-4 w-1/3">
        <form wire:submit.prevent="{{ $event_id ? 'update' : 'store'}}">
            <div>
                <label>Titulo</label>
                <input type="text" wire:model="titulo" class="w-full rounded" required>
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

           <div>
                <label>Status</label>
                <select wire:model="$status" class="w-full rounded">
                    <option value="">Selecione o Status</option>
                    @foreach($eventsStatus as $status)
                        <option value="{{ $status['id'] }}">{{ $status['label'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Descrição</label>
                <textarea wire:model="descricao" class="w-full rounded"></textarea>
            </div>

            <div>
                <label>Localização</label>
                <input type="text" wire:model="localizacao" class="w-full rounded">
                @error('price_sell') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Capacidade Maxima</label>
                <input type="number" wire:model="capacidade_maxima" class="w-full rounded">
                @error('price_buy') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Horario Inicial</label>
                <input type="datetime-local" wire:model="horario_inicio" class="w-full rounded">
                @error('quantity') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Horario Final</label>
                <input type="datetime-local" wire:model="horario_final" class="w-full rounded">
                @error('quantity') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                 <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ $event_id ? 'Update' : 'Save' }}
                </button>
                <button wire:click.prevent="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>



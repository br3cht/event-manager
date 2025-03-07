<div class="container max-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Eventos</h1>
        <div class="flex space-x-4">
            <div class="flex-1"></div>
            <button wire:click="create()" class="
            font-bold
            text-white
            rounded-md
            px-4
            py-2
            bg-blue-800"
            >
                Evento +
            </button>

            @if($isOpen)
                @include('livewire.event-create')
            @endif
        </div>
    </div>

    @if($openParticpants)
     @include('livewire.components.eventCrud.listParticipants')
    @endif

    @if($openDelete)
     @include('livewire.components.eventCrud.deleteEvent')
    @endif

    @if(!empty($events))
       @foreach($events as $event)
        <div id="eventos-lista" class="space-y-4">
            <div class="event-card bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-xl font-semibold text-gray-800">{{$event->titulo}}</h3>
                    @if($event->status == 'open')
                        <span class="bg-green-200 text-green-800 text-sm font-medium py-1 px-3 rounded-full">{{$event->status}}</span>
                    @else
                        <span class="bg-green-200 text-red-800 text-sm font-medium py-1 px-3 rounded-full">{{$event->status}}</span>
                    @endif
                </div>
                <p class="text-gray-600">{{$event->localizacao}}</p>
                <p class="text-gray-600">{{$event->inicio}}</p>
                <p class="text-gray-600 text-sm mt-2">{{$event->descricao}}</p>
                <div class="mt-4">
                    <button wire:click="showInscriptions({{$event->id}})" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 shadow-md ">
                        Visualizar Inscrições
                    </button>
                </div>
                <div class="mt-4">
                    <button
                    wire:click="edit({{$event->id}})"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Editar
                    </button>
                </div>
                <div class="mt-4">
                    <button
                    wire:click="showDelete({{$event->id}})"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition">
                        Deletar
                    </button>
                </div>
            </div>
       @endforeach
    <div class="mt-4">
        {{ $events->links() }}
    </div>
    @endif
</div>


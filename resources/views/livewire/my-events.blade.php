<div class="container mx-auto mt-8">
    <!-- Cabeçalho -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Eventos</h1>
    </div>

    @auth
        @if($isOpen)
            @include('livewire.cancelSubscription')
        @endif
    @endauth

    @if(!empty($events))
       @foreach($events as $event)
        <!-- Lista de Eventos -->
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
                <p class="text-gray-600">{{$event->inicio}}</p>
                <p class="text-gray-600">{{$event->localizacao}}</p>
                <p class="text-gray-600 text-sm mt-2">{{$event->descricao}}</p> <!-- Descrição do Evento -->
                <div class="mt-4">
                    <button
                        wire:click="openModal({{$event->id}})"
                        class="bg-red-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Cancelar Inscrição
                    </button>
                </div>
            </div>
       @endforeach
    @endif
</div>


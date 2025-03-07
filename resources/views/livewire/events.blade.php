<div class="container mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Eventos</h1>

    </div>

    @if($openMessageError)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                <button wire:click="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                    <h2 class="text-lg font-semibold mb-4">Inscrever-se no Evento</h2>
                    <p class="text-gray-600 mb-4">Tem certeza de que deseja se inscrever neste evento?</p>
                    <div class="flex justify-end">
                        <button wire:click.prevent="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                        <button wire:click="subscribe()" class="bg-blue-500 text-white px-4 py-2 rounded">Inscrever-se</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @auth
        @if($isOpen)
            @include('livewire.subscribe')
        @endif
    @endauth

    @guest
        @if($isOpen)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                    <button wire:click="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    @include('livewire.login')
                </div>
            </div>
        @endif
    @endguest

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
                @if($event->status == 'open')
                    <div class="mt-4">
                        <button
                        wire:click="openModal({{$event->id}})"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                            Inscrever-se
                        </button>
                    </div>
                @else
                    <div class="mt-4">
                        <button class="bg-gray-500 text-white px-6 py-2 rounded-lg shadow-md cursor-not-allowed" disabled>
                            Evento Encerrado
                        </button>
                    </div>
                @endif
            </div>
       @endforeach
    <div class="mt-4">
        {{ $events->links() }}
    </div>
    @endif
</div>


<div class="container max-auto mt-8">
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

    @if(!empty($events))
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Status</th>
                    <th>Descricao</th>
                    <th>localizacao</th>
                    <th>Capacidade Maxima</th>
                    <th>Horario Inicio</th>
                    <th>Horario Final</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event )
                    <tr>
                        <td>{{ $event->titulo }}</td>
                        <td>{{ $event->status }}</td>
                        <td>{{ $event->descricao }}</td>
                        <td>{{ $event->localizacao }}</td>
                        <td>{{ $event->capacidade_maxima }}</td>
                        <td>{{ $event->inicio }}</td>
                        <td>{{ $event->final }}</td>
                        <td>
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $event->id }})" class="bg-yellow-500 text-white px-2 py-2">
                                    Editar
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Links de paginação -->
        <div class="mt-4">
            {{ $events->links() }}
        </div>
    @endif
</div>


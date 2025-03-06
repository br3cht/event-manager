<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-4">Registro</h2>

        <form wire:submit.prevent="registerUser">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="name" wire:model="name"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" id="email" wire:model="email"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" id="password" wire:model="password"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Registrar
            </button>
        </form>
    </div>
</div>


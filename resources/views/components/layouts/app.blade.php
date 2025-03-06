<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
      <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4 bg-white p-4 rounded-lg shadow-md">
                <a href="/"><h1 class=" text-2xl font-semibold text-gray-800">Event Manager</h1></a>
            </div>
        </div>

        {{$slot}}

</body>
</html>

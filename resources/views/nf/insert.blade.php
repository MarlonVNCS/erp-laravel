<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inserir NF</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form action="{{ route('upload.xml') }}" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md space-y-4" method="POST" enctype="multipart/form-data">
        @csrf
        
        <h2 class="text-xl font-semibold text-center text-gray-700">Preencha as informações</h2>

        <div>
            <label for="date" class="block text-gray-600 font-medium">Insira a data de entrada</label>
            <input type="date" name="date" id="date" value="@php echo date('Y-m-d');@endphp" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="time" class="block text-gray-600 font-medium">Insira a hora de entrada</label>
            <input type="time" name="time" id="time" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="file" class="block text-gray-600 font-medium">Insira o arquivo XML</label>
            <input type="file" name="file" id="file" accept=".xml" class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-200">
            Enviar
        </button>
        
    </form>
</body>
</html>
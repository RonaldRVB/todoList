<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    @vite('resources/css/app.css') <!-- Assure-toi que le CSS est bien inclus -->
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Ma Todo List</h1>
        
        <!-- Formulaire d'ajout d'une nouvelle tâche -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="flex justify-center">
                <input type="text" name="title" placeholder="Nouvelle tâche" required class="border border-gray-300 rounded-l px-4 py-2 w-1/3" />
                <button type="submit" class="bg-blue-500 text-white rounded-r px-4 py-2 hover:bg-blue-600">Ajouter</button>
            </div>
        </form>

        <!-- Liste des tâches -->
        <div class="overflow-hidden rounded-lg border border-gray-300">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tâche</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }} onchange="this.form.submit()" class="mr-2">
                                    <span class="{{ $task->completed ? 'line-through text-gray-400' : '' }}">{{ $task->title }}</span>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


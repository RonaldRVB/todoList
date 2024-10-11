<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Récupère toutes les tâches
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // Valide le titre de la tâche
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Crée une nouvelle tâche
        Task::create([
            'title' => $request->title,
            'completed' => false, // Par défaut, la tâche est non terminée
        ]);

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, $id)
    {
        // Marquer une tâche comme complétée
        $task = Task::findOrFail($id);
        $task->update(['completed' => $request->has('completed')]);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        // Supprime une tâche
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index');
    }
}

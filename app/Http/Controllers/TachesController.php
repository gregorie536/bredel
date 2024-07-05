<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;

class TachesController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user.couple')->get();

        return Inertia::render('Tache', [
            'tasks' => $tasks,
        ]);
    }

    public function unassign($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->user_id = null;
        $task->save();

        return redirect()->route('taches.index');
    }
}

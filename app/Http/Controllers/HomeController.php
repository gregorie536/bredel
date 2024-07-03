<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Presence;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->get();
        $presences = Presence::with('user')->get();

        $response = [
            'tasks' => $tasks,
            'presences' => $presences,
        ];

        return Inertia::render('Home', $response);
    }
}


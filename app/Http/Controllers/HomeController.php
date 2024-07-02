<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->get();

        $response = [
            'tasks' => $tasks
        ];

        return Inertia::render('Home', $response);
    }
}


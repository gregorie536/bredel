<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\ChildPresence;
use Inertia\Inertia;

class PresencesController extends Controller
{
    public function index()
    {
        $presences = Presence::with('user.couple')->get();
        $childPresences = ChildPresence::with('child')->where('present', true)->get();

        return Inertia::render('Presence', [
            'presences' => $presences,
            'childPresences' => $childPresences,
        ]);
    }
}

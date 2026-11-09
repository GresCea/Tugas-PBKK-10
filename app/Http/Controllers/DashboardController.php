<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the authenticated user's dashboard with their latest projects.
     */
    public function __invoke(Request $request): View
    {
        $projects = $request->user()
            ->projects()
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard', [
            'projects' => $projects,
            'statistics' => [
                'users' => User::count(),
                'projects' => Project::count(),
                'admins' => User::whereHas('roles', fn ($query) => $query->where('name', 'Admin'))->count(),
            ],
        ]);
    }
}

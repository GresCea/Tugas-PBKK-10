<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless($request->user()->can('projects.view'), 403);

        $projects = Project::with('user')
            ->when($request->filled('search'), function ($query) use ($request): void {
                $query->where(function ($query) use ($request): void {
                    $query->where('judul', 'like', '%'.$request->string('search').'%')
                        ->orWhere('tema_agent', 'like', '%'.$request->string('search').'%')
                        ->orWhereHas('user', fn ($user) => $user->where('name', 'like', '%'.$request->string('search').'%'));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()->can('projects.view'), 403);

        return view('projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless($request->user()->can('projects.view'), 403);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tema_agent' => ['required', 'string', 'max:255'],
            'api_key_secure' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->projects()->create($validated);

        return to_route('projects.index')->with('status', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project): View
    {
        abort_unless(auth()->user()->can('projects.view'), 403);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        abort_unless($request->user()->can('projects.view'), 403);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tema_agent' => ['required', 'string', 'max:255'],
            'api_key_secure' => ['required', 'string', 'max:255'],
        ]);

        $project->update($validated);

        return to_route('projects.index')->with('status', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        abort_unless(auth()->user()->can('projects.delete'), 403);

        $project->delete();

        return to_route('projects.index')->with('status', 'Project berhasil dihapus.');
    }
}

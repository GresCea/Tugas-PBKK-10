@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard Akademik</h1>
@stop

@section('content')
    @if (session('status'))
        <x-adminlte-alert theme="success" title="Berhasil">{{ session('status') }}</x-adminlte-alert>
    @endif

    <div class="row">
        <div class="col-lg-4 col-6">
            <x-adminlte-small-box title="{{ $statistics['users'] }}" text="Total Pengguna" icon="fas fa-users" theme="primary" />
        </div>
        <div class="col-lg-4 col-6">
            <x-adminlte-small-box title="{{ $statistics['projects'] }}" text="Total Project" icon="fas fa-project-diagram" theme="success" url="{{ route('projects.index') }}" />
        </div>
        <div class="col-lg-4 col-6">
            <x-adminlte-small-box title="{{ $statistics['admins'] }}" text="Administrator" icon="fas fa-user-shield" theme="warning" />
        </div>
    </div>

    <x-adminlte-card title="Project Terbaru" theme="primary" icon="fas fa-list">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Judul</th><th>Tema</th><th>Pemilik</th><th>Dibuat</th></tr></thead>
                <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->judul }}</td>
                        <td>{{ $project->tema_agent }}</td>
                        <td>{{ $project->user->name }}</td>
                        <td>{{ $project->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Belum ada data project.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </x-adminlte-card>
@stop

@extends('adminlte::page')

@section('title', 'Projects')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Project</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
    </div>
@stop

@section('content')
    @if (session('status'))
        <x-adminlte-alert theme="success" title="Berhasil">{{ session('status') }}</x-adminlte-alert>
    @endif
    <x-adminlte-card title="Daftar Project" theme="primary" icon="fas fa-table">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-10"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari judul, tema, atau pemilik..."></div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Cari</button></div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>Judul</th><th>Tema</th><th>Pemilik</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->judul }}<div class="small text-muted">{{ Str::limit($project->deskripsi, 80) }}</div></td>
                        <td>{{ $project->tema_agent }}</td>
                        <td>{{ $project->user->name }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('projects.edit', $project) }}">Edit</a>
                            @can('projects.delete')
                                <form class="d-inline" method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Hapus project ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Data tidak ditemukan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $projects->links() }}
    </x-adminlte-card>
@stop

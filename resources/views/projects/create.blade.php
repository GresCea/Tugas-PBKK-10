@extends('adminlte::page')
@section('title', 'Tambah Project')
@section('content_header')<h1>Tambah Project</h1>@stop
@section('content')
    <x-adminlte-card title="Form Project" theme="primary">
        @include('projects.form', ['project' => null, 'action' => route('projects.store'), 'method' => 'POST'])
    </x-adminlte-card>
@stop

@extends('adminlte::page')
@section('title', 'Edit Project')
@section('content_header')<h1>Edit Project</h1>@stop
@section('content')
    <x-adminlte-card title="Form Project" theme="primary">
        @include('projects.form', ['action' => route('projects.update', $project), 'method' => 'PUT'])
    </x-adminlte-card>
@stop

@extends('layouts.app')

@section('content')
    <div
        class="">
        <div>
            @livewire('welcome.header')
        </div>
        <div>
            @livewire('todo.todo-form')
        </div>
        <div>
            @livewire('todo.todo-list')
        </div>
    </div>
@endsection

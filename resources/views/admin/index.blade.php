@extends('layouts.app')

@section('content')
    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">
        @livewire('welcome.header')
        @livewire('user.user-list')
    </div>
@endsection

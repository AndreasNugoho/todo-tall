<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoForm extends Component
{
    public $title;
    public $todo;


    public function store(){
        $id = Auth::user()->id;

        $this->validate([
            'title' =>'required|string'
        ]);

        Todo::create([
            'title' => $this->title,
            'user_id' => $id
        ]);

        $this->title = NULL;

        session()->flash('success', 'task berhasil di tambahkan');
        $this->dispatch('todoStore');
    }



    public function render()
    {
        return view('livewire.todo.todo-form');
    }
}

<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoEdit extends Component
{
    public $todo;
    public $todo_id;
    public $title;
    public function mount($todo){
        // $this->todo = $todo;
        $this->title = $todo->title;
        $this->todo_id = $todo->id;
    }
    public function render()
    {
        return view('livewire.todo.todo-edit');
    }

    public function update(){
        $id = Auth::user()->id;

        $this->validate([
            'title' =>'required|string'
        ]);

        Todo::where('id',$this->todo_id)->update([
            'title' => $this->title,
            'user_id' => $id
        ]);

        $this->title = NULL;

        redirect()->route('todo.index')->with('success','todo berhasil diupdate');
    }
}

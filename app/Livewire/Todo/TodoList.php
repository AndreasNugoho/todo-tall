<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class TodoList extends Component
{
    protected $listeners = [
        'todoComplete' => 'render',
        'todoStore' => 'render',
        'todoDelete' => 'render',
        'todoUpdate' => 'render',
    ];
    public $todo;
    public $todo_id;
    public $title;


    public function render()
    {
        return view('livewire.todo.todo-list');

    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        session()->flash('success', 'todo berhasil dihapus');
        $this->dispatch('todoDelete');
    }

    public function edit(Todo $todo){
        $this->title = $todo->title;
        $this->todo = $todo;
        $this->todo_id = $todo->id;
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

        $this->dispatch('todoUpdate');


    }

    public function complete($id){
        $currentDateTime = new DateTime();
        $todo = Todo::find($id);
        $todo->completed = ! $todo ->completed;
        if($todo->completed == TRUE){
            // dd('harusnya ini bener');
            Todo::where('id', $id)->update([
                'completed_at' => $currentDateTime
            ]);
        }else{
            // dd('harusnya ini salah');
            Todo::where('id', $id)->update([
                'completed_at' => NULL
            ]);
        }

        // dd($todo);
        $todo->save();
        $this->dispatch('todoComplete');
    }



}

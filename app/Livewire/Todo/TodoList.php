<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class TodoList extends Component
{
    protected $listeners = [
        'todoStore' => 'render',
        'todoComplete' => 'render',
        'todoDelete' => 'render',
    ];

    public $todo;
    public $todo_id;
    public $title;
    public $todo_delete;
    public $todo_id_delete;
    public $title_delete;

    // public function mount(){
    //     $this->title = $this->todo->title;
    // }


    public function render()
    {
        $id = Auth::user()->id;
        return view('livewire.todo.todo-list',[
            'todos' => Todo::where('user_id', $id)->orderBy('id','desc')->get(),
        ]);
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
    public function editDelete(Todo $todo){
        $this->title_delete = $todo->title;
        $this->todo_delete = $todo;
        $this->todo_id_delete = $todo->id;
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

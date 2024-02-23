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
        'todoComplete' => 'render'
    ];

    public $todo;

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

    public function complete($id){
        $currentDateTime = new DateTime();
        $todo = Todo::find($id);
        if($todo->complete == TRUE){
            $todo->completed_at =  $currentDateTime->format('d-m-Y');
        }else{
            $todo->completed_at = NULL;
        }
        $todo->completed = ! $todo ->completed;
        $todo->save();
        $this->dispatch('todoComplete');
    }
}

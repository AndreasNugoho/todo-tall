<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TodoComplete extends Component
{
     protected $listeners = [
        'todoComplete' => 'mount',
        'todoUpdate' => 'mount',
        'todoDelete' => 'mount',
        'todoStore' => 'mount',
    ];
    public $todos;

    public $todo;
    public $todo_id;
    public $title;

    use WithPagination;

    protected $paginationTheme = 'tailwind';



    public function mount() {
        $id = Auth::user()->id;
        $this->todos = Todo::where('user_id', $id)->orderBy('id','desc')->get();
        $this->todos = $this->todos->filter( function($todos) {
            return  $todos->completed;
        });
    }

      public function edit(Todo $todo){
        $this->title = $todo->title;
        $this->todo = $todo;
        $this->todo_id = $todo->id;
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        session()->flash('success', 'todo berhasil dihapus');
        $this->dispatch('todoDelete');
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

    public function complete($id)
    {
        $currentDateTime = new DateTime();
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        if ($todo->completed == TRUE) {
            // dd('harusnya ini bener');
            Todo::where('id', $id)->update([
                'completed_at' => $currentDateTime
            ]);
        } else {
            // dd('harusnya ini salah');
            Todo::where('id', $id)->update([
                'completed_at' => NULL
            ]);
        }

        $todo->save();
        $this->dispatch('todoComplete');
    }

    public function render()
    {
        return view('livewire.todo.todo-complete');
    }
}

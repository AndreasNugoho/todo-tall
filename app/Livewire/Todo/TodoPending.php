<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoPending extends Component
{

     protected $listeners = [
        'todoComplete' => 'mount',
        'todoUpdate' => 'mount',
        'todoDelete' => 'mount',
        'todoStore' => 'mount',
        'filterDate' => 'mount',
    ];
    public $todos;

    public $todo;
    public $todo_id;
    public $title;

    public $dateFilter;

    public $search;

    public $date_due;

    public $hariIni;

    public $changeFormatDueDate;

    public $cekDueDate;




     public function mount() {
        $id = Auth::user()->id;
        $dateNya = $this->dateFilter;
        $this->todos = Todo::where('user_id', $id)->orderBy('id','desc')->get();
        $this->todos = $this->todos->filter( function($todos) {
            return  ! $todos->completed;
        });
        $todosNya = $this->todos;
        // $dataNyaConvert = $dateNya->toDateTimeString();

        foreach ($todosNya as $item) {
            $convertCreated = date_format($item->created_at,"Y-m-d");
            // dd($dataNyaConvert);

             if($dateNya != '') {
                $convertDataNya = date_format($dateNya,"Y-m-d");
                $this->todos = Todo::where('user_id',$id)->where('due_at','like','%'.$convertDataNya.'%')->orderBy('id','desc')->get();
                    $this->todos = $this->todos->filter( function($todos) {
                        return  ! $todos->completed;
                    });
            }else{

            }
            $dueDateTodo = $item->due_at;
            $this->changeFormatDueDate = $dueDateTodo->format('Y-m-d');
            $this->hariIni = Carbon::now()->format('Y-m-d');
            $cekDueDate =Todo::whereDate($this->hariIni,'>',$this->changeFormatDueDate)->orderBy('due_at','asc');
            // dd($cekOverDue);
            // $this->cekDueDate = $cekOverDue;

        }
        // $this->cekDueDate = Todo::where('user_id', $id)->whereDate($this->hariIni,$this->changeFormatDueDate);


    }

    public function filterDate($day, $month, $year){
        $strDate = $day.$month.$year;
        $this->dateFilter = new Carbon($strDate);
        $this->dispatch('filterDate');
    }

     public function edit(Todo $todo){
        // dd($todo);
        $this->title = $todo->title;
        $this->todo = $todo;
        $this->todo_id = $todo->id;
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        // dd($todo);
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

        $todo->save();
        $this->dispatch('todoComplete');
    }

    public function overDue($due_at){
        // dd($due_at);
        $id = Auth::user()->id;
        $formatDate = $due_at->format('Y-m-d');


        $cekDueDate =Todo::where('user_id',$id)->whereDate($this->hariIni,'>',$formatDate)->orderBy('due_at','desc');
        // dd($cekDueDate);
        $today = Carbon::now();
        $due = new Carbon($formatDate);
        // dd($today, $due);

        if($today > $due){
            $diff =$today->diffInDays($formatDate,false);
            return "Overdue". " ".abs($diff)." "."days";
        }else{
            return "On Duty";
        }

    }



    public function render()
    {
        // $this->overDue($today,$due_at);
        return view('livewire.todo.todo-pending');
    }

}

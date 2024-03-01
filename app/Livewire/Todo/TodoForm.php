<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoForm extends Component
{
    public $title;
    public $date;
    public $todo;



     public function selectDate($day, $month, $year)
    {
        // dd('jalan');
         $strDate = $day.$month.$year;
        //  dd($strDate);
         $this->date =  new Carbon($strDate);
        $selectedDate = $this->date;
        // dd($selectedDate);
    }

    public function store(){

        if($this->date == NULL){
            $this->date = Carbon::now();
        }


        $id = Auth::user()->id;
        $this->validate([
            'title' =>'required|string',
        ]);

        // dd($this->date);


        Todo::create([
            'title' => $this->title,
            'user_id' => $id,
            'due_at' =>  $this->date,
        ]);

        $this->title = NULL;

        // session()->flash('success', 'task berhasil di tambahkan');
        $this->dispatch('todoStore');
    }



    public function render()
    {
        return view('livewire.todo.todo-form');
    }
}

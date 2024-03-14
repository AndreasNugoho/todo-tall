<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TodoPending extends Component
{

     protected $listeners = [
        'todoComplete' => 'mount',
        'todoUpdate' => 'mount',
        'todoDelete' => 'mount',
        'todoStore' => 'mount',
        'filterDate' => 'mount',
        'filterDateTo' => 'mount',
        'resetDate' => 'mount',
    ];
    public $todos;

    public $todo;
    public $todo_id;
    public $title;

    public $dateFilter;
    public $dateFilterTo;

    public $search;

    public $date_due;

    public $hariIni;

    public $changeFormatDueDate;

    public $cekDueDate;

    public $selisih;

    use WithPagination;

    protected $paginationTheme = 'tailwind';


    public $cari = '';


     public function mount() {
        $id = Auth::user()->id;
        $dateNya = $this->dateFilter;
        $dateToNya = $this->dateFilterTo;

        $this->todos = Todo::where('user_id', $id)->where('completed', FALSE)->paginate(4);
        $this->todos = $this->todos->filter( function($todos) {
            return  ! $todos->completed;
        });
        $todosNya = $this->todos;
        // $dataNyaConvert = $dateNya->toDateTimeString();

        foreach ($todosNya as $item) {
            $convertCreated = date_format($item->created_at,"Y-m-d");
            // dd($dataNyaConvert);

            if($dateNya != '' AND $dateToNya != ''){
                // dd($dateNya, $dateToNya);
                $convertDue = new Carbon($item->due_at);
                // dd(gettype($dateNya));
                // dd($convertDue);
                $cekTodo = Todo::where('user_id', $id);
                $this->todos = $cekTodo->whereDate('due_at','>=',$dateNya)->whereDate('due_at','<=',$dateToNya)->where('completed',FALSE)->paginate(4);
                $this->todos = $this->todos->filter( function($todos) {
                    return  ! $todos->completed;
                });
                // dd($this->todos);
                // return view('livewire.todo.todo-pending');


            }

            //  if($dateNya != '') {
            //     $convertDataNya = date_format($dateNya,"Y-m-d");
            //     $this->todos = Todo::where('user_id',$id)->where('due_at','like','%'.$convertDataNya.'%')->orderBy('id','desc')->get();
            //         $this->todos = $this->todos->filter( function($todos) {
            //             return  ! $todos->completed;
            //         });
            // }elseif($dateNya == '') {
            //     $this->todos = $this->todos->filter( function($todos) {
            //         return  ! $todos->completed;
            //     });
            // }
            // dd($dateNya,$dateToNya);



            $dueDateTodo = $item->due_at;
            $this->changeFormatDueDate = $dueDateTodo->format('Y-m-d');
            $this->hariIni = Carbon::now()->format('Y-m-d');
            $cekDueDate =Todo::whereDate($this->hariIni,'>',$this->changeFormatDueDate)->orderBy('due_at','asc');
            // if($this->cari !== ''){
            //     dd('jalan');
            // }
        }


    }

    public function filterDate($day, $month, $year){
        $strDate = $day.$month.$year;
        $this->dateFilter = new Carbon($strDate);
        $this->dispatch('filterDate');
    }

    public function filterDateTo($day, $month, $year){
        $strDate = $day.$month.$year;
        $this->dateFilterTo = new Carbon($strDate);
        // dd($this->dateFilterTo);
        $this->dispatch('filterDateTo');
    }
    public function resetDate(){
        $this->dateFilter = '';
        $this->dateFilterTo = '';
        $this->dispatch('resetDate');
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
        // session()->flash('success', 'todo berhasil dihapus');
        $this->dispatch('todoDelete');
    }

    public function cariData($cari){
        if($cari !== ''){
            dd('jalan');
        }else{
            dd('gak jalan');
        }
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
        $diff =$today->diffInDays($formatDate,false);
        $this->selisih = $diff;
        // return $diff;
        if($diff < 0){
            return "Overdue". " ".abs($diff)." "."days";
        }elseif($diff == 0 ){
            return "Overdue Today";
        }else{
            return "On Duty";
        }
    }

    public function color(){

        if (abs($this->selisih) > 0) {
            return "white";
        } elseif (abs($this->selisih) == 0) {
            return "pink";
        }else{
            return "yellow";
        }
    }



    public function render()
    {
        // $this->overDue($today,$due_at);
        $tes = $this->todos;
        $id = Auth::user()->id;


        if($this->dateFilter !== NULL AND $this->dateFilterTo !== NULL){
            return view('livewire.todo.todo-pending',[
            'todonya' => Todo::where('user_id', $id)->whereDate('due_at','>=',$this->dateFilter)->whereDate('due_at','<=',$this->dateFilterTo)->where('completed',FALSE)->where('completed',FALSE)->paginate(8)
        ]);
        }elseif($this->cari !== ''){
            return view('livewire.todo.todo-pending',[
                'todonya' => Todo::where('user_id', $id)->where('completed',FALSE)->where('title', 'like', '%'.$this->cari.'%')->paginate(8)
            ]);
        }else{
            return view('livewire.todo.todo-pending',[
                'todonya' => Todo::where('user_id', $id)->where('completed',FALSE)->orderBy('due_at','asc')->paginate(8)
            ]);
        }


    }

}

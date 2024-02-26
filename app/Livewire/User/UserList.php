<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    protected $listener = [
        'todoStore'=> 'render',
    ];
    public function render()
    {
        return view('livewire.user.user-list',[
            'users' => User::orderBy('id','desc')->withCount('todos')->get()
        ]);
    }


}

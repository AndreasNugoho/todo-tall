<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function edit($id){
        $todo = Todo::where('id', $id)->first();
        return view('todo.edit', [
            'todo' => $todo
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function users()
    {
        return redirect()->route('admin.index');
    }
    public function AdminDashboard(){
        return view('admin.index');
    }

}

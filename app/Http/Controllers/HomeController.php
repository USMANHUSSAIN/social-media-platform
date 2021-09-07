<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->hasRole('Admin'))
            return view('admin');
        return view('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function counter()
    {
        return view('counter.index');
    }
    public function comments()
    {
        return view('comments.index');
    }
}

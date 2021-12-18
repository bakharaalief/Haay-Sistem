<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    //return index for normal user
    public function index()
    {
        return view('home');
    }

    //return index for admin
    public function adminIndex()
    {
        return view('admin-home');
    }
}

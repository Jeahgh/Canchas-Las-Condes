<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CanchasController extends Controller
{
    public function index(){
        return view('canchas.canchas');
    }
}

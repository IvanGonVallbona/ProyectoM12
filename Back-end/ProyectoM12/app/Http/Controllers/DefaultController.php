<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    function home() 
    { 
      return view('default.home');
    }
}

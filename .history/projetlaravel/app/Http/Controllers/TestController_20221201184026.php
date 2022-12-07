<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
   public function index() 
   {
    return view('login');
   }

   //creer la fonctions store
   public function store(Request $request)
   {
    $request->validate([
        'email' =>'required'
    ]);
     dd($request->all());
   }
}

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
    $validate = Validator::make($request->all(), [
        
        'email' => 'required',
       
        'mdp' => 'required',
    ]);
if($validate->fails()){
return back()->withErrors($validate->errors())->withInput();
}


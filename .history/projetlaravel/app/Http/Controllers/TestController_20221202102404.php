<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        
        'email' => 'required |max:255|regex:/(.*)@myemail\.com/i|unique:users',
       
        'mdp' => 'required',
    ],[
        'email.required' => 'Email est obligatoire',
        'email.regex' => 'Email est obligatoire',
        
    ]);
if($validate->fails()){
return back()->withErrors($validate->errors())->withInput();
}

   }}
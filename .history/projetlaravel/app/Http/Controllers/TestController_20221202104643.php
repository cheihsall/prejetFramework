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
        
        'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
       
        'mdp' => 'required',
    ],[
        'email.required' => 'Email est obligatoire',
        'email.regex' => 'Email incorrect',
        
    ]);
if($validate->fails()){
return back()->withErrors($validate->errors())->withInput();
}

   }}
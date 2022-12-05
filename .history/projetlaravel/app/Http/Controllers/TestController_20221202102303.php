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
        
        'email' => 'required|min:5 ',
       
        'mdp' => 'required',
    ],[
        'email.required' => 'Email est obligatoire',
        'email.min' => 'Email doit etre 5 caracteres'
    ]);
if($validate->fails()){
return back()->withErrors($validate->errors())->withInput();
}

   }}
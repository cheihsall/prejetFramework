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
        'em' => 'required|min:5',
        'email' => 'required',
        'gender' => 'required',
        'password' => 'required',
    ],[
        'name.required' => 'Name is must.',
        'name.min' => 'Name must have 5 char.',
    ]);
if($validate->fails()){
return back()->withErrors($validate->errors())->withInput();
}
}

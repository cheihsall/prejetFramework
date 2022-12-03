<?php

namespace App\Http\Controllers;

use App\Models\utilisateur;
use Illuminate\Http\Request;

class Utilisateurs extends Controller
{


    //controle formulaire

    public function inscription(Request $request){

        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $email = $request->get('email');
        $mdp = $request->get('passwords');
        $mdp1 = $request->get('passwords2');
        $role = $request->get('roles');


        $validation = $request->validate([

            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required | regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'passwords' => 'required',
            'roles' => 'required',
            'passwords2' => 'required',
            
        ]);
        return $validation;


        
    }
    

    public function login(Request $request){

        $email = $request->get('email');
        $mdp = $request->get('passwords');


        $valid = $request->validate([
            'email' => ['required', 'regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'passwords' => 'required',    
        ]);
        return $valid;


        
    }
}
 ?> 


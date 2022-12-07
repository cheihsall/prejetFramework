<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades;
use App\Models\utilisateur;
use Illuminate\Http\Request;

class Utilisateurs extends Controller
{


    //controle formulaire
 
    public function inscription(Request $request){

        return $request->all();


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
     //controle de saisie login 

    public function login(Request $request){

        $email = $request->get('email');
        $mdp = $request->get('mdp');


        $valid = $request->validate([
            'email' => ['required', 'email','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'mdp' => 'required', 'string',   
        ]);

       $utilisateur= Utilisateur::where("email",$valid["email"])->first();
       //
       if(!$utilisateur) return response(["message"=>"l'email n'existe pas"]);
       if (!Hash::check($utilisateur['mdp'],$utilisateur->mdp)) response(["message"=>"mdp incorrect"]);
       //
       
       return $utilisateur;


        
    }
}
 ?> 


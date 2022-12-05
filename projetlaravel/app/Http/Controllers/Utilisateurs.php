<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\utilisateur;
use Illuminate\Http\Request;

class Utilisateurs extends Controller
{


<<<<<<< HEAD
   

    public function inscription(Request $request){

    /*     $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $email = $request->get('email');
        $mdp = $request->get('passwords');
        $mdp1 = $request->get('passwords2');
        $role = $request->get('roles');  
 */
         //controle formulaire
=======
    //controle formulaire
 
    public function inscription(Request $request){

        return $request->all();

>>>>>>> 72113e6cbbbd28458c90cfc660369c7859d01b0c

        $validation = $request->validate([

            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required |regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'passwords' => 'required',
            'roles' => 'required',
            'passwords2' => 'required_with:passwords|same:passwords',
        
            
        ]);
        return $validation;


        
    }
     //controle de saisie login 

    public function login(Request $request){

        $email = $request->get('email');
        $mdp = $request->get('passwords');


        $valid = $request->validate([
            'email' => ['required', 'email','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'passwords' => 'required', 'string',   
        ]);

       $utilisateur= Utilisateur::where("email",$valid["email"])->first();
       $pass= Utilisateur::where("motdepasse",$valid["passwords"])->first();
       //
       if(!$utilisateur ) return response(["message"=>"l'email n'existe pas"]);
       /* if (!Hash::check($utilisateur['passwords'],$utilisateur->passwords)) response(["message"=>"mdp incorrect"]); */
       //
        if(!$pass ) return response(["message"=>"pass n'existe pas"]); 
       return $utilisateur;


        
    }
}
 ?> 


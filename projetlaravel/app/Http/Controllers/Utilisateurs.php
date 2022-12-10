<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\utilisateur;
use Illuminate\Http\Request;

class Utilisateurs extends Controller
{

<<<<<<< HEAD
     //controle de saisie login 
=======


     //controle de saisie login
>>>>>>> 0b309da53551aabb2b4761716611a345d1adc412

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
       if(!$utilisateur ) return response(["message"=>"Email n'existe pas"]);
       /* if (!Hash::check($utilisateur['passwords'],$utilisateur->passwords)) response(["message"=>"mdp incorrect"]); */
       //
<<<<<<< HEAD
        if(!$pass ) return response([]); 
=======
        if(!$pass ) return response(["message"=>"pass n'existe pas"]);
>>>>>>> 0b309da53551aabb2b4761716611a345d1adc412
       return $utilisateur;



    }
}
 ?>


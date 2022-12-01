<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class validform extends Controller
{
    public function inscription(Request $request){

        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $email = $request->get('email');
        $mdp = $request->get('passwords');
        $mdp1 = $request->get('passwords2');
        $role = $request->get('roles');
        $photo = $request->get('photo');

        $validation = $request->validate([

            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required'],
            'passwords' => ['required'],
            'passwords2' => ['required'],
            'role' => ['required']

        ]);

        return $validation;

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\utilisateur;
use Illuminate\Http\Request;

class Utilisateurs extends Controller
{
    function generateMatricule($n = 3)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return 'G5' . $randomString;
    }
    public function addUser(Request $request){

        $user = new utilisateur();

        $user->matricule = $this->generateMatricule();
        $user->nom = $request->get('nom');
        $user->prenom = $request->get('prenom');
        $user->email = $request->get('email');
        $user->motdepasse = $request->get('motdepasse');
        $user->role = $request->get('role');
        $user->photo = $request->get('photo');
        $user->date_inscription = date("y-m-d h:i:s");
        $user->date_archivage = null;
        $user->date_modification = null;
        $user->save();
    }
}
 ?> 
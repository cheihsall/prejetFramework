<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Utilisateurs;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class PostController extends Controller
{




/* creation d'une fonction pour l'ajout des matricules pour chaque utilisateur */
    function generateMatricule($n = 3) /* creation de la fonction avec ses parametres */
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
/* cette boucle nous permet de parcourir la chaine de caractére et d'incrementé de 3 lettre aléatoirement */
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return '2022-' . $randomString;
    }


    public function index()
    {
        session_start();
        if (!isset($_SESSION['matricule'])) return redirect('/login');


        //

        $users = Utilisateur::where('matricule', '!=' , $_SESSION['matricule'])->where('etat', '=', "1")->paginate(8);


        $nbr = Utilisateur::where('etat', '=', "1")->count();



        return view("admin", [
            'users' => $users,
            'nbr' => $nbr
        ]);
    }


    public function usersimple()
    {
        session_start();
        if (!isset($_SESSION['matricule'])) return redirect('/login');

        $users = Utilisateur::where('etat', '=', "1")->paginate(8);

        return view("user", [
            'users' => $users
        ]);
    }

    public function listearchive()
    {


        session_start();
        if (!isset($_SESSION['matricule'])) return redirect('/login');
        $users = Utilisateur::where('etat', '=', "0")->paginate(8);
        $nbr = Utilisateur::where('etat', '=', "0")->count();
        return view("listearchive", [
            'users' => $users,
            'nbr' => $nbr
        ]);
    }

    public function create()
    {
        //
    }




    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'passwords' => 'required', 'string',
        ]);





        $users = Utilisateur::all();

        foreach ($users as $user) {

            if ($user->email == $request->get("email") && $user->motdepasse == $request->get("passwords")) {
                if ($user->etat === "1") {

                    if ($user->role === "administrateur") {
                        /*   Auth::login($user);   */
                        session_start();
                        $_SESSION['nom'] = $user->nom;
                        $_SESSION['matricule'] = $user->matricule;
                        $_SESSION['prenom'] = $user->prenom;
                        $_SESSION['photo'] = $user->photo;
                        $_SESSION['prenom'] = $user->prenom;

                        return redirect("/api/admin");
                    } elseif ($user->role === "utilisateur") {

                        session_start();
                        $_SESSION['nom'] = $user->nom;
                        $_SESSION['matricule'] = $user->matricule;
                        $_SESSION['prenom'] = $user->prenom;
                        $_SESSION['photo'] = $user->photo;
                        $_SESSION['prenom'] = $user->prenom;
                        return redirect("/api/usersimple");
                    }
                }
                $valid = $request->validate([
                    'msg' => 'present',

                ]);
            };
        }

        $valid = $request->validate([
            'msg' => 'accepted',

        ]);
    }

    public function store(Request $request)
    {
        $u = new utilisateur();
        $email = $request->get('email');
        $request->validate([

            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required |regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'passwords' => 'required',
            'roles' => 'required',
            'passwords2' => 'required_with:passwords|same:passwords',


        ]);

        //controle du mail existant
        foreach ($u::all() as $user) {

            if ($user->email === $email) {

                $request->validate([

                    'email' => ['confirmed'],

                ]);
            }
        }

        $etat = '1';

        $user = new Utilisateur();

        $user->matricule = $this->generateMatricule();
        $user->nom = $request->get('nom');
        $user->prenom = $request->get('prenom');
        $user->email = $request->get('email');

        $user->motdepasse = $request->get('passwords');

        $user->role = $request->get('roles');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/user/', $filename);
            $user->photo = $filename;
        } else {

            $user->photo = 'avatarr.jpg';
        }

        $user->etat = $etat;
        $user->date_inscription = date("y-m-d h:i:s");
        $user->date_archivage = null;
        $user->date_modification = null;

        $user->save();

        return redirect("/pupop");
    }


    public function show(string $id)
    {
        $users = Utilisateur::findOrFail($id);

        return view("admin", [
            'users' => array($users)
        ]);
    }


    public function edit(string $id, Request $request)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->nom = $request->get("nom");
        $user->prenom = $request->get("prenom");
        $user->email = $request->get("email");
        $user->date_modification = date("y-m-d h:i:s");
        $user->save();
        return redirect("/api/admin");
    }

    public function switchRole(string $id)
    {
        $user =  Utilisateur::findOrFail($id);
        if ($user->role === "administrateur") {
            $user->role = "utilisateur";
        } else {
            $user->role = "administrateur";
        }
        $user->save();
        return redirect("/api/admin");
    }

    public function editForm(string $id)
    {
        $user = Utilisateur::findOrFail($id);
        return view("editForm", [
            "user" => $user
        ]);
    }

    public function connection()
    {
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(string $id)
    {
        Utilisateur::destroy($id);

        $users = Utilisateur::all();
        return view("admin", [
            'users' => $users
        ]);
    }





    public function archiv(string $id)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->etat = "0";
        $user->date_archivage = date("y-m-d h:i:s");

        $user->save();
        return redirect("/api/admin");
    }



    public function desarchiv(string $id)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->etat =  "1";
        $user->save();
        return redirect("/api/listearchive");
    }
/* cette fonction permet de faire la recherche d'un utilisateur sur la page listeArchive les personnes archivés */
    public function rechinactif(Request $request)
    {
        session_start(); /* demarrage de la session */
        $users = utilisateur::all(); /* recuperation de tous les utilisateurs et stocké dans la variable $users */
        $nbr = Utilisateur::where('etat', '=', "0")->count(); /* recuperation des utilisateurs dont leur etat est egal à 0 c'est à dire archivé et stocké dans la variable $nbr */
        $search = \Request::get('prenom'); /* requete pour obtenir le prenom utilisé pour la recherche */
        $users = Utilisateur::where('prenom', 'like', '%' . $search . '%')->where("etat", "=", "0")/* recuperation des prenom d'utilisateurs  ou a peu prés qui ont comme etat 0 et stocké dans la variable $users */

            ->paginate(8); /* chaque page on aura maximum 8 utilisateurs si la recherche affiche plusieurs resultats*/
        return view("listearchive", ["users" => $users, 'nbr' => $nbr]); /* retourner la page listearchive avec un tableau des utilisateurs trouvés et le nombres total des personnes archivés */
    }


    /* cette fonction permet de faire la recherche d'un utilisateur sur la page admin les personnes actives */
    public function Search(Request $request)
    {
        session_start();
        $users = utilisateur::all();
        $nbr = Utilisateur::where('etat', '=', "1")->count();/* recuperation des utilisateurs dont leur etat est egal à 1 c'est à dire archivé et stocké dans la variable $nbr */
        $search = \Request::get('prenom');
        $users = utilisateur::where('prenom', 'like', '%' . $search . '%')->where("etat", "=", "1")/* recuperation des prenom d'utilisateurs  ou a peu prés qui ont comme etat 1 et stocké dans la variable $users */

            ->paginate(5);    /* chaque page on aura maximum 5 utilisateurs si la recherche affiche plusieurs resultats*/

            /* retourner la page admin avec un tableau des utilisateurs trouvés et le nombres total des personnes actives */
        return view("admin", [
            "users" => $users,
            'nbr' => $nbr
        ]);
    }


        /* cette fonction permet de faire la recherche d'un utilisateur sur la page user les personnes actives */

    public function Search2(Request $request)
    {
        session_start();
        $users = utilisateur::all();
        $nbr = Utilisateur::where('etat', '=', "1")->count();
        $search = \Request::get('prenom');
        $users = utilisateur::where('prenom', 'like', '%' . $search . '%')->where("etat", "=", "1")

            ->paginate(5);

            /* retourner la page utilisateur simple avec un tableau des utilisateurs trouvés et le nombres total des personnes actives */
        return view("user", [
            "users" => $users,
            'nbr' => $nbr
        ]);
    }




    public function deconnect(Request $request)
    {

        session_start();
        session_destroy();
        return redirect('/login');
    }
}

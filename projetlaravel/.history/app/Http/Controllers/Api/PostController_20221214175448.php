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





    function generateMatricule($n = 3)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

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

        $users = Utilisateur::where('matricule', '!=' , $_SESSION['matricule'])->where('etat', '=', "1")->paginate(8);


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


//Debut créationn de la page de connexion

    public function login(Request $request) //creation de la fonction login 
    {
        $request->validate([ // creation d'une variable reponse puis intégration de la méthode validate pour accepter si les règles de validation sont acceptées   non
            ////////////
            'email' => ['required', 'email', 'regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],//require pour controler que le champ est obigatoire ,regex:pour verifier le format de l'email
            'passwords' => 'required', 'string', //////////mdp  pour controler que le champ est obigatoire 
        ]);
           





        $users = Utilisateur::all(); //Récuperation de toutes les users de la bd

        foreach ($users as $user) {  //Parcourir le tableau 

            if ($user->email == $request->get("email") && $user->motdepasse == $request->get("passwords")) { //controler la présence du mot de passe et de l'email
                if ($user->etat === "1") { //Voir si le user qui veut se connecter est archivé ou pas à partir de son etat

                    if ($user->role === "administrateur") { // Redirection à la page admin à partir du role
                        /*   Auth::login($user);   */
                        session_start();//demarrage de la session pour afficher:
                        $_SESSION['nom'] = $user->nom; // affiche nom
                        $_SESSION['matricule'] = $user->matricule;//affichage matricule
                        $_SESSION['prenom'] = $user->prenom;//affichage prenom 
                        $_SESSION['photo'] = $user->photo;//affichage photo 
                        $_SESSION['prenom'] = $user->prenom;

                        return redirect("/api/admin"); // condition remplie diriger à la page admin
                    } elseif ($user->role === "utilisateur") { // Redirection à la page user à partir du role

                        session_start(); //demarrage de la session pour afficher
                        $_SESSION['nom'] = $user->nom; // affiche nom
                        $_SESSION['matricule'] = $user->matricule;//affichage matricule
                        $_SESSION['prenom'] = $user->prenom;//affichage prenom 
                        $_SESSION['photo'] = $user->photo;//affichage photo 
                     
                        return redirect("/api/usersimple");// condition remplie diriger à la page user
                    }
                }
                $valid = $request->validate([
                    'msg2' => 'present',

                ]);
            };
        }

        $valid = $request->validate([
            'msg' => 'accepted',

        ]);
    }

    // Fin de la fonction de connexion

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

    public function rechinactif(Request $request)
    {
        session_start();
        $users = utilisateur::all();
        $nbr = Utilisateur::where('etat', '=', "0")->count();
        $search = \Request::get('prenom');
        $users = Utilisateur::where('prenom', 'like', '%' . $search . '%')->where("etat", "=", "0")
            ->orderBy('prenom')
            ->paginate(8);
        return view("listearchive", ["users" => $users, 'nbr' => $nbr]);
    }


    public function Search(Request $request)
    {
        session_start();
        $users = utilisateur::all();
        $nbr = Utilisateur::where('etat', '=', "1")->count();
        $search = \Request::get('prenom');
        $users = utilisateur::where('prenom', 'like', '%' . $search . '%')->where("etat", "=", "1")

            ->orderBy('prenom')
            ->paginate(5);
        return view("admin", [
            "users" => $users,
            'nbr' => $nbr
        ]);
    }

    public function Search2(Request $request)
    {
        session_start();
        $users = utilisateur::all();
        $nbr = Utilisateur::where('etat', '=', "1")->count();
        $search = \Request::get('prenom');
        $users = utilisateur::where('prenom', 'like', '%' . $search . '%')->where("etat", "=", "1")


            ->orderBy('prenom')
            ->paginate(5);
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

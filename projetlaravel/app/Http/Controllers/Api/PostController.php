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

        $users = Utilisateur::where('matricule', '!=', $_SESSION['matricule'])->where('etat', '=', "1")->paginate(8); //recuperation de la session matricule et filftrage de user connecté dans la liste


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

        $users = Utilisateur::where('matricule', '!=', $_SESSION['matricule'])->where('etat', '=', "1")->paginate(8);  //recuperation de la session matricule et filftrage de user connecté dans la liste


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
            'passwords' => 'required', 'string',
        ]);






        $users = Utilisateur::all(); //Récuperation de toutes les users de la base de donnée

        foreach ($users as $user) {  //Parcourir les utilisateurs

            if ($user->email == $request->get("email") && $user->motdepasse == $request->get("passwords")) { //Verifier si les identifiants saisie correspond aux identifiants de l'utilisateur dans la base de donnée
                if ($user->etat === "1") { //Voir si le user qui veut se connecter est archivé ou pas à partir de son etat

                    if ($user->role === "administrateur") { // Vérification à la page admin à partir du role s'il est un administrateur
                        /*   Auth::login($user);   */
                        session_start();//demarrage de la session pour afficher:
                        $_SESSION['nom'] = $user->nom; // Recuperatio session nom
                        $_SESSION['matricule'] = $user->matricule;//Recup matricule
                        $_SESSION['prenom'] = $user->prenom;//Recup prenom 
                        $_SESSION['photo'] = $user->photo;//Recup photo 
                       

                        return redirect("/api/admin"); 
                    } elseif ($user->role === "utilisateur") {

                        session_start(); 
                        $_SESSION['nom'] = $user->nom;
                        $_SESSION['matricule'] = $user->matricule;
                        $_SESSION['prenom'] = $user->prenom;
                        $_SESSION['photo'] = $user->photo;
                     
                        return redirect("/api/usersimple");
                    }
                }
                //afficher message quand l'utilisateur est archivé :compte archivé
                $valid = $request->validate([
                    'msg' => 'present',

                ]);
            };
        }
                 //afficher message quand l'utilisateur a saisie le mauvais mot de passe ou le mauvais email
        $valid = $request->validate([
            'msg' => 'accepted',

        ]);
    }

    public function store(Request $request)  // function qui fait le controle de saisi

    {
        $u = new utilisateur();
        $email = $request->get('email'); //reuperation email




        $request->validate([  // Verification des champs vide

            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required |regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', //Format email
            'passwords' => 'required',
            'roles' => 'required',
            'passwords2' => 'required_with:passwords|same:passwords',


        ]);



        foreach ($u::all() as $user) {  //Parcourir  la base de donnees et controle du mail existant

            if ($user->email === $email) {

                $request->validate([

                    'email' => ['confirmed'],

                ]);
            }
        }





        $etat = '1';


        $user = new Utilisateur(); // insersion des donnees apres avoir inscri

        $user->matricule = $this->generateMatricule(); // autogerer le matricule
        $user->nom = $request->get('nom');
        $user->prenom = $request->get('prenom');
        $user->email = $request->get('email');

        $user->motdepasse = $request->get('passwords');

        $user->role = $request->get('roles');

        //insersion, recuperation et affichage de la photo

        if ($request->hasFile('photo')) { //si l'utilisateur s'inscrit avec la photo
            $file = $request->file('photo'); // on recupere la photo
            $extension = $file->getClientOriginalExtension(); // cryptage de du nom de la photo
            $filename = time() . '.' . $extension; // recuperation du nom de la crypte avec l'extention original de la photo
            $file->move('uploads/user/', $filename); //inserer la photo crypter dans le dossier uploads user
            $user->photo = $filename; //insersion du chemin de la photo dans la base de donnees
        } else { //si l'utilisateur s'inscrit sans photo

            $user->photo = 'avatarr.jpg'; // il y'a un avatar par defaut
        }

        $user->etat = $etat;
        $user->date_inscription = date("y-m-d h:i:s");
        $user->date_archivage = null;
        $user->date_modification = null;

        $user->save();

        return redirect("/pupop"); // apres avoir inscrit redirection vers pupop et on choisi si on va se connecter ou pas
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

<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Utilisateurs;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;


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

        $users = Utilisateur::where('etat', '=', "1")->paginate(8);

        return view("admin", [
            'users' => $users
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
        return view("listearchive", [
            'users' => $users
        ]);
    }

    public function create()
    {
        //
    }


    //controle de saisie login


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'passwords' => 'required', 'string',
        ]);

        $users = Utilisateur::all();

        foreach ($users as $user) {
            if ($user->email == $request->get("email") && $user->motdepasse == $request->get("passwords")) {

                if ($user->role === "administrateur") {
                    /*   Auth::login($user);   */
                    session_start();
                    $_SESSION['nom'] = $user->nom;
                    $_SESSION['matricule'] = $user->matricule;
                    $_SESSION['prenom'] = $user->prenom;
                    $_SESSION['phot'] = $user->photo;
                    $_SESSION['prenom'] = $user->prenom;

                    return redirect("/api/admin");
                } elseif ($user->role === "utilisateur") {

                    session_start();
                    $_SESSION['nom'] = $user->nom;
                    $_SESSION['matricule'] = $user->matricule;
                    $_SESSION['prenom'] = $user->prenom;
                    $_SESSION['phot'] = $user->photo;
                    $_SESSION['prenom'] = $user->prenom;
                    return redirect("/api/usersimple");
                }
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
        $user->photo = $request->get("photo");
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






    public function recherche(Request $request)

    {session_start();
        $users = Utilisateur::paginate(8);
        $users =  Utilisateur::where('prenom', $request->get('prenom'))->get();
        /*          $users->etat =  "1";
 */
        return view("admin", [
            "users" => $users
        ]);
    }


    public function Search(Request $request)
    {session_start();
        $users = utilisateur::all();
        $search = \Request::get('nom');
        $users = utilisateur::where('nom', 'like', '%' . $search . '%')


            ->orderBy('nom')
            ->paginate(5);
        return view("admin", ["users" => $users]);
    }

    public function Search2(Request $request)
    {session_start();
        $users = utilisateur::all();
        $search = \Request::get('nom');
        $users = utilisateur::where('nom', 'like', '%' . $search . '%')


            ->orderBy('nom')
            ->paginate(5);
        return view("user", ["users" => $users]);
    }




    public function deconnect(Request $request)
    {

        session_start();
        session_destroy();
        return redirect('/login');
    }


    public function rechinactif(Request $request)
    {
        $users =  Utilisateur::where('prenom', $request->get('prenom'))->get();
        $u = [];
        foreach ($users as $user) {
            if ($user->etat == "0") {
                array_push($u, $user);
            }
        }
        $users = $u;
        return view("admin", [
            "users" => $users
        ]);
    }
}

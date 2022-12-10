<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Utilisateurs;


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
    }  /**
     * Afficher une liste de la ressource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  return json_encode(['nom' => 'Cheikh', 'prenom' => 'Sall']); */
       /*  $user = new utilisateur(); */

        $users = Utilisateur::all();
        $u = [];
        foreach ($users as $user) {
            if ($user->etat == "1") {
                array_push($u, $user);
            }
        }
        $users = $u;
        $users = Utilisateur::paginate(10);

       // dd($u);

       /*  foreach($users as $user) { if ($user->etat =="0"){

        }} */

/*         $users = Utilisateur::all();
 */
        return view("admin", [
            'users' => $users
        ]);




        /* return response()->json($users); */
   }



   public function usersimple()
   {

       $users = Utilisateur::all();
       $u = [];
       foreach ($users as $user) {
           if ($user->etat == "1") {
               array_push($u, $user);
           }
       }
       $users = $u;

       return view("user", [
           'users' => $users
       ]);


  }

    public function listearchive()
    {
       /*  return json_encode(['nom' => 'Cheikh', 'prenom' => 'Sall']); */
       /*  $user = new utilisateur(); */
        $users = Utilisateur::all();
        $u = [];
        foreach ($users as $user) {
            if ($user->etat == "0") {
                array_push($u, $user);
                $users = Utilisateur::paginate(10);

            }
        }
        $users = $u;
       // dd($u);

       /*  foreach($users as $user) { if ($user->etat =="0"){

        }} */
        return view("listearchive", [
            'users' => $users
        ]);

    }
    /**
     * Afficher le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

     //controle de saisie login

    public function login(Request $request){

        $email = $request->get('email');
        $mdp = $request->get('passwords');


        $valid = $request->validate([
            'email' => ['required', 'email','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'passwords' => 'required', 'string',
        ]);


        $users = utilisateur::all();
   foreach($users as $user) {
    if ($user->email == $request->get("email") && $user->motdepasse == $request->get("passwords")){
        return redirect("/api/posts");

    }

   }
     return redirect("login");  /*  $utilisateur= Utilisateur::where("email",$valid["email"])->first();
       $pass= Utilisateur::where("motdepasse",$valid["passwords"])->first();
       //
       if(!$utilisateur ) return response(["message"=>"l'email n'existe pas"]);
       /* if (!Hash::check($utilisateur['passwords'],$utilisateur->passwords)) response(["message"=>"mdp incorrect"]); */
       //
    /*     if(!$pass ) return response(["message"=>"pass n'existe pas"]);  */
      /*   return redirect("/api/posts"); */



    }


  /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

       */
   /*
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'passwords' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/api/posts');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
 */


    /**
     * Stocker une ressource nouvellement créée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){



      $request->validate([

            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required |regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'passwords' => 'required',
            'roles' => 'required',
            'passwords2' => 'required_with:passwords|same:passwords',


        ]);





    $etat='1';


        $user = new Utilisateur();

        $user->matricule = $this->generateMatricule();
        $user->nom = $request->get('nom');
        $user->prenom = $request->get('prenom');
        $user->email = $request->get('email');
        $user->motdepasse = $request->get('passwords');
        $user->role = $request->get('roles');
        $user->photo = $request->get(5);
        $user->etat = $etat;
        $user->date_inscription = date("y-m-d h:i:s");
        $user->date_archivage = null;
        $user->date_modification = null;

        $user->save();
        return redirect("/api/posts");


    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $users= Utilisateur::findOrFail($id);

        return view("admin", [
            'users' => array($users) ]);

/*         return response()->json($users); */
    }

    /**
     * Afficher le formulaire de modification de la ressource spécifiée.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id, Request $request)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->nom = $request->get("nom");
        $user->prenom = $request->get("prenom");
        $user->email = $request->get("email");
        $user->save();
        return redirect("/api/posts");
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
        return redirect("/api/posts");
    }

    public function editForm(string $id)
    {
        $user = Utilisateur::findOrFail($id);
        return view("editForm", [
            "user" => $user
        ]);
    }
    public function connection(){

    }
    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Utilisateur::destroy($id);
         $users = Utilisateur::all();
        return response()->json($users);
    }



    public function archiv(string $id)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->etat = "0";
        $user->save();
        return redirect("/api/posts");
    }


    public function desarchiv(string $id)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->etat =  "1";
        $user->save();
        return redirect("/api/listearchive");
    }

    public function recherche(Request $request)
    {
                $users =  Utilisateur::where('prenom', $request->get('prenom'))->get();
                $u = [];
                foreach ($users as $user) {
                    if ($user->etat == "1") {
                        array_push($u, $user);
                    }
                }
                $users = $u;
                return view("admin", [
                    "users" => $users
                ]);



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

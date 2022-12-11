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
    }  /**
     * Afficher une liste de la ressource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = Utilisateur::all();
        $users->where('etat'=='1' )
 
        /* $u = [];

       /*  return json_encode(['nom' => 'Cheikh', 'prenom' => 'Sall']); */
       /*  $user = new utilisateur(); */


/*        ->paginate(10);
 */ /* $users = Utilisateur::all();*/
 

       /*  $users = Utilisateur::all();

        $u = [];

        foreach ($users as $user) {
            if ($user->etat == "1") {
                array_push($u, $user);
                
            }
        }

        $users = $u() ;
       

        $users = $u;
        $users = Utilisateur::paginate(10); */

       // dd($u);

       /*  foreach($users as $user) { if ($user->etat =="0"){

        }} */

/*         $users = Utilisateur::all();
 */

/* $users = Utilisateur::paginate(8); */


        ->orderBy('nom')
        ->paginate(5);
        //::paginate(10);

        return view("admin", [
            'users' => $users
        ]);
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

       $users = Utilisateur::paginate(8);

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

        }} */$users = Utilisateur::paginate(8);
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


    /* public function inscription(Request $request){

        return $request->all();


        $validation = $request->validate([

            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required | regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix ',
            'passwords' => 'required',
            'roles' => 'required',
            'passwords2' => 'required',

        ]);
        return $validation;



    } */

     //controle de saisie login


    public function login( Request $request){


       /*  $email = $request->get('email');
        $mdp = $request->get('passwords');
 */

        $valid = $request->validate([
            'email' => ['required', 'email','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'passwords' => 'required', 'string',
        ]);
       




  

  
       $users= Utilisateur::all();
       foreach($users as $user){
        if($user->email == $request->get("email") && $user->motdepasse == $request->get("passwords")) 
       {
        if ($user->role === "administrateur"){
          return redirect("/api/posts");  
        }
        elseif ($user->role === "utilisateur") {
            return view("inscription");
        }
        
        };
       
       }
   
      
       $valid = $request->validate([
        'msg' => 'accepted',
       
    ]);
      
 




    }



  /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

       */
   /*
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
        $user->photo = $request->get("photo");
        $user->etat = $etat;
        $user->date_inscription = date("y-m-d h:i:s");
        $user->date_archivage = null;
        $user->date_modification = null;

        $user->save();
        return redirect("/api/admin");


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








    public function connection(){

    }
    /**
     * Mettre à jour la ressource spécifiée dans le stockage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
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

    {$users = Utilisateur::paginate(8);
        $users =  Utilisateur::where('prenom', $request->get('prenom'))->get();
/*          $users->etat =  "1";
 */
        return view("admin", [
            "users" => $users
        ]);

        
        }


        public function Search(Request $request)
        {
            $users = utilisateur::all();
            $search = \Request::get('nom'); 
            $users = utilisateur::where('nom','like','%'.$search.'%')
                ->orderBy('nom')
                ->paginate(5);
                return view("admin" ,["users"=>$users]);
        }
     



        public function session(LoginRequest $request)
    {
        $request->authenticate();

        session_start();

        return redirect("/api/admin");
    }





    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deconnect(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }







    /* function init_php_session():bool
    {
        if(!session_id())
        {
            session_start();
            session_regenerate_id();
            return true;
        }
        return false;
    }
   

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



        } */

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

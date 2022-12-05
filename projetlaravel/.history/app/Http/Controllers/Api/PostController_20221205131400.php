<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utilisateurs;
use App\Models\Post;
use App\Models\utilisateur;
use Illuminate\Http\Request;

class PostController extends Controller
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
    }  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  return json_encode(['nom' => 'Cheikh', 'prenom' => 'Sall']); */
       /*  $user = new utilisateur(); */
        $users = Utilisateur::all();

        return view("tableau", [
            'users' => $users
        ]);

        /* return response()->json($users); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
    

        $user = new Utilisateur();

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
        return redirect("/api/posts");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $users = Utilisateur::findOrFail($id);

        return view("tableau", [
            'users' => array($users) ]);

/*         return response()->json($users); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id, Request $request)
    {
        $user =  Utilisateur::findOrFail($id);
        $user->nom = $request->get("nom");
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
     * Update the specified resource in storage.
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
        //
    }
}

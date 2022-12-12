<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\MongoDB\Client;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\utilisateur;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */ function generateMatricule($n = 3)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return '2022-' . $randomString;
    } 
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'required',
    'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $etat='1';
        $name = $request->file('image')->getClientOriginalName();
 
        $path = $request->file('image')->store('image');
        
        $user = new User();

        $user->matricule = $this->generateMatricule();
        $user->nom = $request->get('name');
        $user->prenom = $request->get('prenom');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->get('roles');
        $user->name = $name;
        $user->photo = $path;
        $user->etat = $etat;
        $user->date_inscription = date("y-m-d h:i:s");
        $user->date_archivage = null;
        $user->date_modification = null;

        $user->save();

        event(new Registered($user));

       Auth::login($user); 

       return redirect(RouteServiceProvider::HOME);
    }
}

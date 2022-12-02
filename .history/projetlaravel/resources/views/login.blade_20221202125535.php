<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
    
    <title>Page de Connexion</title>
</head>

<body>

    <div class=" container d-flex justify-content-center mt-5">
        <!--     <img src="./views/img/decor.png" alt="" >
 -->
        <div class="col-md-8 ">

            <div class="row d-flex justify-content-center  bg-white-50 t-5 ">
              


                <form action="{{route('login.store') }}" method="post" class="row g-2 d-block bg-red col-md-8">
                    @csrf
                    <nav class="navbar  bg-success">
                        <div class="container d-flex justify-content-center">
                            <a class="navbar-brand" href="#">
                                <span class="text-white">Connexion</span>
                            </a>

                    </nav>

                    <div class="col-md-12 p-2 input-control">
                        <label for="">Email</label>
                        <input id="email" class="form-control " type='text' id="email" name='email' placeholder=" Email ">
                     
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            <br>
                            @enderror
                    
                        </div>

                    <div class="col-md-12 p-2 ">
                        <label for="input2">Mot de Passe</label>
                        <input id="passwords" class="form-control border-dark p-3" type="password" name="mdp" id="mdp" placeholder="mot de passe">
                        <!--div class="invalid-feedback d-none" id="erreur_passwords">mot de passe est obligatoire</div-->
                        @error('mdp')
                        <span class="text-danger">{{$message}}</span>
                        <br>
                        @enderror
                
                    </div>

                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success col-3" id="submit">
                            Connexion
                        </button>

                    </div>

                    <span class="text text-center mt-2">
                        <p>Vous n'avez pas de compte?
                            <a href="./views/pages/inscription.php" style="text-decoration:none;">S'inscrire</a>
                        </p>
                    </span>
                </form>
            </div>
        </div>

    </div>


</body>

</html>

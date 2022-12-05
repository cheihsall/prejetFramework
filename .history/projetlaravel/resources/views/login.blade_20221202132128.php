<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>Page de Connexion</title>
</head>

<body>

    <div class=" container d-flex justify-content-center mt-5">
        <!--     <img src="./views/img/decor.png" alt="" >
 -->
        <div class="col-md-8">

            <div class="row d-flex justify-content-center bg-white-50  ">
              

                <form action="{{route('login.store') }}" method="post" class="row g-2 d-block  col-md-8  bg-light needs-validation border  " novalidate>
                    @csrf
                    <nav class="navbar bg-success mt-0 col-md-12">
                        <div class="container d-flex justify-content-center col-md-12">
                            <a class="navbar-brand" href="#">
                                <span class="text-white">Connexion</span>
                            </a>

                    </nav>

                    <div class="col-md-12 p-2 input-control">
                        <label for="" class="form-label">Email <span>*</span></label>
                        <input id="email" class="form-control border-dark p-2" type='text' id="email" name='email' placeholder=" Email ">
                     
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            <br>
                            @enderror
                    
                        </div>

                    <div class="col-md-12 p-2">
                        <label >Mot de Passe</label>
                        <input id="passwords" class="form-control border-dark p-2" type="password" name="mdp" id="mdp" placeholder="mot de passe">
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

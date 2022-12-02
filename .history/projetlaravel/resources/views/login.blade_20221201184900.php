
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Page CONNEXION</title>
</head>

<body>

    <div class=" container d-flex justify-content-center mt-5">
<!--     <img src="./views/img/decor.png" alt="" >
 -->        <div class="col-md-8 ">

            <div class="row d-flex justify-content-center mt-5 ">
                


                <form action="{{route('login.store')}}" method="post" class="row g-2 d-block bg-transparent col-md-8">
                    @csrf
                    <nav class="navbar navbar-dark bg-success">
                        <div class="container d-flex justify-content-center">
                            <a class="navbar-brand" href="#">
                                <span class=""> <b>CONNEXION </b> </span>
                            </a>
                        
                    </nav>

                    <div class="col-md-12 p-3">
                        <label for="">E-MAIL</label>
                        <input id="email" class="form-control border-dark p-3 " type='text' id="email" name='email'  placeholder=" Email ">
                        <!--div class="invalid-feedback d-none" id="erreur_email2">entrez un format valide</div>
                        <div class="invalid-feedback d-none" id="erreur_email">Email est obligatoire</div-->
                    </div>

                    <div class="col-md-12 p-3 ">
                        <label for="input2">Mot de Passe</label>
                        <input id="passwords" class="form-control border-dark p-3" type="password" name="mdp" id="mdp" placeholder="mot de passe">
                        <!--div class="invalid-feedback d-none" id="erreur_passwords">mot de passe est obligatoire</div-->

                    </div>

                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success col-3" id="submit">
                            Connexion
                        </button>

                    </div>

                    <span class="text text-center mt-2">
                        <p>Vous n'avez pas de compte?
                            <a href="./views/pages/inscription.php" style="text-decoration:none;">s'inscrire</a>
                        </p>
                    </span>
                </form>
            </div>
        </div>

    </div>
     

</body>

</html>
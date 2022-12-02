<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Inscription</title>
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-md-8  mt-5">
            <form id="form" enctype="multipart/form-data" class="row g-3 d-flex justify-content-center no-wrap m-2  bg-light needs-validation border" novalidate action="/inscription" method="POST">
                @csrf
                <nav class="navbar navbar-dark bg-success mt-0">
                    <div class="container-fluid d-flex justify-content-center">
                        <a class="navbar-brand pe-none" href="#">
                            <b> FORMULAIRE INSCRIPTION</b>
                        </a>   
                    </div>
                </nav>
                <div class="col-md-6 input-control">
                    <label for="input1" class="form-label">Nom<span style="color: red;">*</span></label>
                    <input type='text' name='nom' class="form-control border-dark p-2 @error('nom') is-invalid @enderror" value="{{old('nom')}}" id="nom" required>
                    @error('nom')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 input-control">
                    <label for="input2" class="form-label">Prenom<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-2 @error('prenom') is-invalid @enderror" value="{{old('prenom')}}" name="prenom" id="prenom" required> 
                    @error('prenom')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 input-control">
                    <label for="input3" class="form-label">Email<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-2 @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" id="email" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 input-control">
                    <label for="input7" class="form-label">Rôles<span style="color: red;">*</span></label>
                    <select name="roles" class="form-select border-dark p-2 @error('roles') is-invalid @enderror" value="{{old('roles')}}" id="roles" required>
                        <option selected disabled value=""></option>
                        <option value="administrateur" name='roles'>Admin</option>
                        <option value="utilisateur" name='roles'>User</option>
                    </select>
                    @error('roles')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 input-control">
                    <label for="input5" class="form-label">Mot de passe<span style="color: red;">*</span></label>
                    <input type="password" class="form-control border-dark p-2 @error('passwords') is-invalid @enderror" value="{{old('passwords')}}" name="passwords" id="passwords" required>
                    @error('passwords')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 input-control">
                    <label for="input6" class="form-label">Confirme mot de passe<span style="color: red;">*</span></label>
                    <input type="password" class="form-control border-dark p-2 @error('passwords') is-invalid @enderror" value="{{old('passwords2')}}" name="passwords2" id="passwords2" required>
                    @error('passwords2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 input-control">
                    <label for="input4" class="form-label">Photo de profil</label>
                    <input type="file" name="photo" accept=".jpg,.png,.jpeg" class="form-control border-dark p-2">
                </div>
                 
                <div class="row d-flex justify-content-center mt-2">
                    <button type="submit" class="btn btn-success col-3" id="submit">
                        S'inscrire
                    </button>
                </div>

                <span class="text text-center mt-2">
                    <p>Vous avez un compte ?      
                        <a href="" style="text-decoration:none;"> connectez-vous</a>
                    </p>
                </span>
            </form>
        </div>
    </div>
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
    <div class="container d-flex justify-content-center mt-4">
        <div class="col-md-8  mt-4">
            <br>

            <nav class="navbar navbar-dark bg-success mt-4">
                <div class="container-fluid d-flex justify-content-center">
                    <a class="navbar-brand pe-none" href="#">
                        <b> FORMULAIRE INSCRIPTION</b>
                    </a>
                </div>
            </nav>

            <form id="form" enctype="multipart/form-data" class="row g-3 d-flex justify-content-center no-wrap m-2  bg-light needs-validation" novalidate action="inscription.php" method="post">
                <div class="col-md-6 input-control">
                    <label for="input1" class="form-label">Nom<span style="color: red;">*</span></label>
                    <input type='text' name='nom' class="form-control border-dark p-2" id="nom" required>
                    <div class="invalid-feedback d-none" id="erreur_nom"> Nom est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input2" class="form-label">Prenom<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-2" name="prenom" id="prenom" required>
                    <div class="invalid-feedback d-none" id="erreur_prenom">Prenom est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input3" class="form-label">Email<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-2" name="email" id="email" required>
                    <div class="invalid-feedback d-none" id="erreur_email">Email est obligatoire</div>
                    <div class="invalid-feedback d-none" id="erreur_email2">Entrez un format valide</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input7" class="form-label">Rôles<span style="color: red;">*</span></label>
                    <select name="roles" class="form-select border-dark p-2" id="roles" required>
                        <option selected disabled value=""></option>
                        <option value="administrateur" name='roles'>Admin</option>
                        <option value="utilisateur" name='roles'>User</option>
                    </select>

                    <div class="invalid-feedback d-none" id="erreur_roles">Rôle est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input5" class="form-label">Mot de passe<span style="color: red;">*</span></label>
                    <input type="password" class="form-control border-dark p-2" name="passwords" id="passwords" required>
                    <div class="invalid-feedback d-none" id="erreur_passwords">mot de passe est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input6" class="form-label">Confirme mot de passe<span style="color: red;">*</span></label>
                    <input type="password" class="form-control border-dark p-2" name="passwords" id="passwords2" required>
                    <div class="invalid-feedback d-none" id="erreur_passwords2">veuillez confirmer votre mot de passe</div>
                    <div class="invalid-feedback d-none" id="confpasswords">mot de passe non identiques</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input4" class="form-label">Ajouter une image</label>
                    <input type="file" name="photo" accept=".jpg,.png,.jpeg" class="form-control border-dark p-2">
                </div>

                <div class="row d-flex justify-content-center mt-2">
                    <button type="submit" class="btn btn-success col-3" id="submit">
                        S'inscrire
                    </button>
                </div>

                <span class="text text-center mt-2">
                    <p>Vous avez un compte?
                        <a href="../../index.php" style="text-decoration:none;"> connectez-vous</a>
                    </p>
                </span>
            </form>
        </div>
    </div>
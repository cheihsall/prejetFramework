<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>modification</title>
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-md-8  mt-5">
            <form id="form" enctype="multipart/form-data"
                class="row g-3 d-flex justify-content-center no-wrap m-2  bg-light needs-validation border" novalidate
                action="/api/posts/edit/{{ $user->id }}" method="POST">


                @csrf
                <nav class="navbar navbar-dark bg-success mt-0">
                    <div class="container-fluid d-flex justify-content-center">
                        <a class="navbar-brand pe-none" href="#">
                            <b> modification</b>
                        </a>
                    </div>
                </nav>
                <div class="col-md-6 input-control">
                    <label for="input1" class="form-label">Nom<span style="color: red;">*</span></label>
                    <input type='text' name='nom' placeholder="nom" value="<?= $user['nom'] ?? null ?>"
                        class="form-control border-dark p-2" id="nom">
                    <div class="invalid-feedback d-none" id="erreur_nom"> Nom est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input2" class="form-label">Prenom<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-2" value="<?= $user['prenom'] ?? null ?>"
                        name="prenom" placeholder="prenom" id="prenom">
                    <div class="invalid-feedback d-none" id="erreur_prenom">Prenom est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input3" class="form-label">Email<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-2" value="<?= $user['email'] ?? null ?>"
                        name="email" placeholder="email" id="email">
                    <div class="invalid-feedback d-none" id="erreur_email">Email est obligatoire</div>
                    <div class="invalid-feedback d-none" id="erreur_email2">entrez un format valide</div>
                </div><br>

                <div class="row d-flex justify-content-center mt-2 gap-2">
                    <button type="submit" class="btn btn-success col-3" id="submit">
                        Enregistré
                    </button>
                    <button type="reset" class="btn btn-danger col-3" id="submit">
                        <a class="text-light text-decoration-none" href="/api/admin"> Annuler</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<script>
    let erreur_email = document.getElementById("erreur_email")
    let erreur_email2 = document.getElementById("erreur_email2")
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    let submit = document.getElementById("submit")
    let erreur_prenom = document.getElementById("erreur_prenom")
    let erreur_nom = document.getElementById("erreur_nom")
    let nom = document.getElementById("nom")
    let prenom = document.getElementById("prenom")
    let email = document.getElementById("email")

    const checkemail = () => {
        resetemail()
        if (email.value.trim() === "") {
            erreur_email.classList.remove("d-none")
            erreur_email.classList.add("d-flex")
            email.style.border = "1px solid red"
            return false;
        }
        if (!regex.test(email.value.trim())) {
            erreur_email2.classList.remove("d-none")
            erreur_email2.classList.add("d-flex")
            email.style.border = "1px solid red"

            return false;
        }

        resetemail()
        return true;

    }
    const resetemail = () => {
        erreur_email.classList.remove("d-flex")
        erreur_email.classList.remove("d-none")
        erreur_email2.classList.remove("d-flex")
        erreur_email2.classList.remove("d-none")
        email.style.border = "1px solid black"
    }

    const resetnom = () => {
        erreur_nom.classList.remove("d-flex")
        erreur_nom.classList.remove("d-none")
        nom.style.border = "1px solid black"

    }

    const checknom = () => {
        resetnom()
        if (nom.value.trim() === "") {
            erreur_nom.classList.remove("d-none")
            erreur_nom.classList.add("d-flex")
            nom.style.border = "1px solid red"
            return false;
        }
        resetnom()
        return true;
    }

    const resetprenom = () => {
        erreur_prenom.classList.remove("d-flex")
        erreur_prenom.classList.remove("d-none")
        prenom.style.border = "1px solid black"
    }

    const checkprenom = () => {
        resetprenom()
        if (prenom.value.trim() === "") {
            erreur_prenom.classList.remove("d-none")
            erreur_prenom.classList.add("d-flex")
            prenom.style.border = "1px solid red"
            return false;
        }
        resetprenom()
        return true;
    }

    submit.addEventListener("click", (e) => {
        console.log("clicked");
        if ((!checkemail() && !checknom() && !checkprenom()) || !checkemail() || !checknom() || !
        checkprenom()) {
            e.preventDefault()
        }

    })
</script>

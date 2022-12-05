<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>page admin</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-success p-5">
            <div class="d-flex flex-column">
                <img src="..." class="rounded" alt="photo">
                <span>matricule</span>
            </div>
            <div class="me-5 d-flex flex-row">
                <span>prenom</span>&nbsp;

                <span>nom</span>&nbsp;
            </div>

            <div class="d-flex justify-content-center m-3 navbar-nav me-auto mb-lg-0">
                <a class="nav-link active text-light m-2" aria-current="page" href="#"><button type="button" class="btn btn-outline-success ">
                        <img src="./image/dearchiv.png" alt=""> Liste des archivés
                    </button></a>
            </div>
           @include('/recherche')
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="">
                <button type="button" class="btn btn-outline-success "><img src="./image/deconect.png" alt="deconnecter">Deconnecter</button>
            </a>
        </nav>
    </header>
    <main>
        <div class="m-5">
            <table class="table caption-top border border-success">
                <thead class="table-success">
                    <tr>
                        <th scope="col">NOM</th>
                        <th scope="col">PRENOM</th>
                        <th scope="col">E-MAIL</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Role</th>
                        <th scope="col">ACTION</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">SOW</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>778897668</td>
                        <td>778897668</td>
                        <td><a href=""><img src="./image/archiv.png" alt=""></a>
                            <a href=""><img src="./image/change.png" alt=""></a>
                            <a href=""><img src="./image/edit.png" alt=""></a>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">SOW</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>778897668</td>
                        <td>778897668</td>
                        <td><a href=""><img src="./image/archiv.png" alt=""></a>
                            <a href=""><img src="./image/change.png" alt=""></a>
                            <a href=""><img src="./image/edit.png" alt=""></a>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">SOW</td>
                        <td>Larry</td>
                        <td>Bird</td>
                        <td>778897668</td>
                        <td>778897668</td>
                        <td><a href=""><img src="./image/archiv.png" alt=""></a>
                            <a href=""><img src="./image/change.png" alt=""></a>
                            <a href=""><img src="./image/edit.png" alt=""></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>

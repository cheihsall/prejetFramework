
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>page user</title>
</head>
<body>

    <header>
    <nav class="navbar navbar-expand-lg bg-success p-5">
    <div class="d-flex flex-column">
     <img src="..." class="rounded" alt="photo">
      <span>matricule</span>
      </div>
      <div class="me-2 d-flex flex-row">
      <span>prenom</span>&nbsp;

      <span>nom</span>&nbsp;
    </div>

    <div class="d-flex justify-content-center m-3 navbar-nav me-auto mb-lg-0">
        <a class="nav-link active text-light m-2" aria-current="page" href="#"><button type="button" class="btn btn-outline-success ">
                <img src="./image/dearchiv.png" alt=""> Liste des archivés
            </button></a>
    </div>
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="rechercher ..." aria-label="Search">
        <button class="btn btn-outline-light p-1" type="submit">rechercher</button>
    </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="/login">
        <button type="button" class="btn btn-outline-success "><img src="/image/deconect.png" alt="deconnecter">Deconnecter</button>
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
      <th scope="col">Date inscription</th>

    </tr>
  </thead>
  <tbody>

    @foreach ($users as $user)
    <tr>

      <td cope="row">{{{ $user->nom }}}</td>
      <td>{{{ $user->prenom }}}</td>
      <td>{{{ $user->email }}}</td>
       <td>{{{ $user->matricule }}}</td>

      <td>{{{ $user->date_inscription }}}</td>


    </tr>
    @endforeach
  </tbody>
</table>
</div>
</main>
</body>
</html>

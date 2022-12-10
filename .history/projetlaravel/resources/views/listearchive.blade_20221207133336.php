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
          <a class="nav-link active text-light m-2" aria-current="page" href="/api/posts">Actif</a>
        </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="rechercher ..."  width="200"aria-label="Search">
        <button class="btn btn-outline-light p-1" type="submit">rechercher</button>
      </form>
      <ul class="nav-item m-2">
          <a class="nav-link text-light" href="">Deconnecter</a>
</ul>
</nav>
    </header>
    <main>
        <div class="m-5">
        <table class="table caption-top border border-success">
        <thead class="table-success">
    <tr>
      <th scope="col">NOM</th>
      <th scope="col">PRENOM</th>
      <th scope="col">Matricule</th>
      <th scope="col">Date archivage</th>
      {{-- <th scope="col">Etat</th> --}}
    {{--   <th scope="col">Pass</th> --}}
      <th scope="col">ACTION</th>

    </tr>
  </thead>
  <tbody>

  @foreach ($users as $user)
    <tr>

      <td cope="row">{{{ $user->nom }}}</td>
      <td>{{{ $user->prenom }}}</td>
       <td>{{{ $user->matricule }}}</td>
      <td>{{{ $user->date_archivage = date("y-m-d h:i:s");
    }}}</td>
     {{--  <td>{{{ $user->etat }}}</td> --}}
     {{--  <td>{{{ $user->motdepasse }}}</td> --}}



     <td> {{-- <a href="/api/posts/switchRole/{{$user->id}}?post"><img src="/image/change.png" alt=""></a> --}}
        {{-- <form action="/api/posts/switchRole/{{$user->id}}" method="post">
        <button type="submit"><img src="/image/change.png" alt=""></button>
    </form> --}}
        <a href="/api/posts/desarchiv/{{$user->id}}"><img src="/image/archiv.png" alt=""></a>
       {{--  <a href="posts/editForm/{{$user->id}}"><img src="/image/edit.png" alt=""></a> --}}
       {{--  <a href="/api/posts/switchRole/{{$user->id}}?post"><img src="/image/edit.png" alt=""></a> --}}
  </td>
    </tr>
    @endforeach

  </tbody>
</table>
</div>

</main>
</body>

</html>


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
        <nav class="navbar navbar-expand-lg bg-success p-4">
          <div class="d-flex flex-column">
            <img src="{{ $_SESSION['phot'] }}" class="rounded-circle" height="100" width="100" alt="photo">
             <span class="text-light h3">{{ $_SESSION['matricule'] }}</span>
        </div>&nbsp;&nbsp;&nbsp;
        <div class="me-5 d-flex flex-row">
            <span class="text-light h3">{{ $_SESSION['prenom'] }}</span>&nbsp;&nbsp;
            <span class="text-light h3">{{ $_SESSION['nom'] }}</span>&nbsp;

        </div>
        <div class="d-flex justify-content-center m-3 navbar-nav me-auto mb-lg-0">
          <a class="nav-link active text-light m-2 h3" aria-current="page" href="/api/admin">Actifs</a>
        </div>
        <form class="d-flex" role="search" action="rechinactif" method="GET">
            <input class="form-control me-2 px-4" name="prenom" id="recherche" onchange="search()" value="{{ request()->prenom ?? ''}}" type="search" placeholder="rechercher par prenom" aria-label="Search" required>
            <a style="position: absolute; right: 10;" href="/api/admin">
              <img class="mt-1" src="/image/quit.png" alt="quitter" width="22">

      </a>
            <button class="btn btn-outline-light p-1" id="but" onclick="buts()" type="submit">rechercher</button>
        </form>&nbsp;
       {{--  <div class="nav-item mb-3 p-2" >
          <a href="/api/listearchive">
          <button type="button" id="quit" class="btn btn-outline-danger mt-4 p-1 " style="">
              <img src="/image/quit.png" alt="quitter" width="30">
          </button>
      </a>
  </div> --}}
      <ul class="nav-item m-2">
        <a href="/login">
            <button type="button" class="btn btn-outline-success "><img src="/image/deconect.png" alt="deconnecter">Deconnecter</button>
        </a>
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
      <th scope="col">ACTION</th>

    </tr>
  </thead>
  <tbody>
  @if ($users->count() > 0)
    @foreach ($users as $user)
    <tr>

      <td cope="row">{{{ $user->nom }}}</td>
      <td>{{{ $user->prenom }}}</td>
      <td>{{{ $user->matricule }}}</td>
      <td>{{{ $user->date_archivage = date("d-m-y")
    }}}</td>
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
  @else:
    <span id="ok" class="w-75 h-25 mb-2 h5 d-flex justify-content-center border-none t  text-danger">
      L'utilisateur recherché ne figure pas sur cette liste !
  </span>
  @endif


  </tbody>
</table>
<div class="pagination d-flex justify-content-center fixed-bottom">
  {{$users->links()}}
</div>
</div>

</main>
</body>
{{-- <script>
  function search(){
  let recherche = document.getElementById('recherche');
  let quit = document.getElementById('quit');

  if (recherche.value !=" "){
       quit.style.display = "block";

  }
  }

</script> --}}
</html>


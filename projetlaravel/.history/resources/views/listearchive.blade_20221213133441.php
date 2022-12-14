<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>page admin</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-success p-4">
          <div class="d-flex flex-column">
            <img src="/uploads/user/{{ $_SESSION['photo'] }}" class="rounded-circle" height="100" width="100" alt="photo" title="Photo de Profil">
             <span class="text-light h3"title="matricule">{{ $_SESSION['matricule'] }}</span>
        </div>&nbsp;&nbsp;&nbsp;
        <div class="me-5 d-flex flex-row">
            <span class="text-light h3">{{ $_SESSION['prenom'] }}</span>&nbsp;&nbsp;
            <span class="text-light h3">{{ $_SESSION['nom'] }}</span>&nbsp;
         
        </div>
        
        <div class="d-flex justify-content-center m-3 navbar-nav me-auto mb-lg-0">
          <a class="nav-link active text-light m-2" aria-current="page" href="/api/admin"><button type="button" class="btn btn-outline-success ">


            <i class="fa-solid fa-user-check" style="color:white; font-size:35px;padding-left:345px; padding-top:4px;"></i> Utilisateurs actifs



              </button></a>
      </div>
      
        <form class="d-flex" role="SEARCH" action="search3" method="get">
            <input class="form-control me-2" name="prenom" id="recherche" onchange="search()" value="{{ request()->prenom ?? ''}}" type="search" placeholder="rechercher par prenom" aria-label="Search" required>
            <button class="btn btn-outline-light p-1" id="but" onclick="buts()" type="submit">rechercher</button>
        </form>&nbsp;
        <span class="text-light" style="margin-top:auto;max-height: 2.5rem;">Total actifs:&nbsp;<span class="text-light h3"> {{ $nbr }}</span></span>&nbsp;
      <ul class="nav-item m-2">

        <a href="/api/logout">
            <button type="button" class="btn btn-outline-success "><i
              class="fa-solid fa-arrow-right-from-bracket" style="color:white; font-size:35px; padding-top:12px;"></i>Deconnecter</button>

        </a>
    </ul>
</nav>{{-- /*the great suspender*/ --}}
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

  @foreach ($users as $user)
    <tr>

      <td cope="row">{{{ $user->nom }}}</td>
      <td>{{{ $user->prenom }}}</td>
       <td>{{{ $user->matricule }}}</td>
      <td>{{{ $user->date_archivage}}}</td>
     <td> {{-- <a href="/api/posts/switchRole/{{$user->id}}?post"><img src="/image/change.png" alt=""></a> --}}style="color:#334155; padding-left:25px"title="D??sarchiver"
        {{-- <form action="/api/posts/switchRole/{{$user->id}}" method="post">
        <button type="submit"><img src="/image/change.png" alt=""></button>
    </form> --}}
   
        <a href="/api/posts/desarchiv/{{$user->id}}"></a>
       {{--  <a href="posts/editForm/{{$user->id}}"><img src="/image/edit.png" alt=""></a> --}}
       {{--  <a href="/api/posts/switchRole/{{$user->id}}?post"><img src="/image/edit.png" alt=""></a> --}}
  </td>
    </tr>
    @endforeach

  </tbody>
</table>
<div class="pagination d-flex bg-black justify-content-center ">
  {{$users->links()}}
</div>
</div>

</main>
</body>

</html>


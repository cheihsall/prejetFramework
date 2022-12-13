

<?php /* session_start() */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>page admin</title>
</head>

<body>

    <header>
        @if (isset($header))
        <header class="bg-success shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
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
                <a class="nav-link active text-light m-2" aria-current="page" href="/api/listearchive"><button type="button" class="btn btn-outline-success ">

                        <img src="/image/dearchiv.png"> Inactifs
                    </button></a>
            </div>

            <div class="ml-auto  mt-3 " style="margin-left:auto;max-height: 2.5rem;">
                       <form style="position: relative" class="d-flex" action="search" method="GET" role="search">
                        <input class="form-control me-2 px-4" name="prenom" id="recherche" value="{{ request()->prenom ?? ''}}" type="search" placeholder="Recherche par prenom"
                        required  aria-label="Search">
                        <a style="position: absolute; right: 10;" href="/api/admin">
                                <img class="mt-1" src="/image/quit.png" alt="quitter" width="22">

                        </a>
                        <button class="btn btn-outline-light p-1" id="but" type="submit">rechercher</button>
                    </form>
                </div>
            {{-- <div class="nav-item mb-3 p-2" >
                <a href="/api/admin">
                <button type="button" id="quit" class="btn mt-4 p-1 " style="">
                    <img src="/image/quit.png" alt="quitter" width="30">
                </button>
            </a>
        </div> --}}
            <a href="/api/logout">
                <button type="button" class="btn btn-outline-success "><img src="/image/deconect.png" alt="deconnecter">Deconnecter</button>
            </a>
        </nav>


    </header>
    <main>
        <div class="m-5">
        <table class="table caption-top border border-dark">
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
    @if ($users->count() > 0)
  @foreach ($users as $user)
    <tr>

      <td cope="row">{{{ $user->nom }}}</td>
      <td>{{{ $user->prenom }}}</td>
      <td>{{{ $user->email }}}</td>
       <td>{{{ $user->matricule }}}</td>

      <td>{{{ $user->role }}}</td>


      {{-- <td>{{{ $user->motdepasse }}}</td> --}}

      <td><a href="/api/posts/switchRole/{{$user->id}}?post"><img class="btn-outline-secondary" src="/image/change.png" alt="changer"></a>

        {{-- <form action="/api/posts/switchRole/{{$user->id}}" method="post">
        <button type="submit"><img src="/image/change.png" alt=""></button>
    </form> --}}
        <a href="/api/posts/archiv/{{$user->id}}"><img class="btn-outline-danger" src="/image/archiv.png" alt="archiver"></a>
        <a href="posts/editForm/{{$user->id}}"><img class="btn-outline-success" src="/image/edit.png" alt="modifier"></a>
       {{--  <a href="/api/posts/switchRole/{{$user->id}}?post"><img src="/image/edit.png" alt=""></a> --}}
  </td>
    </tr>
    @endforeach
     @else:
      <span id="ok" class="w-75 h-25 mb-2 h5 d-flex justify-content-center border-none text-danger">
        L'utilisateur recherché ne figure pas sur cette liste !
    </span>
    @endif
  </tbody>
</table>
   <div class="pagination d-flex justify-content-center fixed-bottom ">
         {{$users->links()}}

       {{--   <script>
            function search(){
        let recherche = document.getElementById('recherche');
        let quit = document.getElementById('quit');

        if (recherche.value !=" "){
            quit.style.display = "block";

        }
    }

         </script> --}}
</div>
</div>
</main>
</body>
</html>



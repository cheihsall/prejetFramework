

<?php /* session_start() */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


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


                    <i class="fa-solid fa-list" style="color:white; font-size:35px; padding-top:25px;padding-left:25em"></i> <span>liste des archives</span>



                    </button></a>
            </div>
            {{-- <form class="d-flex" role="search" action="recherche" method="post">
                <input class="form-control me-2" name="prenom" id="recherche" onchange="search()" value="{{ request()->prenom ?? ''}}" type="search" placeholder="rechercher par prenom" aria-label="Search" required>
                <button class="btn btn-outline-light p-1" id="but" onclick="buts()" type="submit">rechercher</button>
            </form>--}} <div class="ml-auto  mt-3 " style="margin-left:auto;max-height: 2.5rem;">
                       <form class="d-flex" action="search" method="GET" role="search">
                        <input class="form-control me-2" name="nom" type="search" placeholder="Recherche"
                        required  aria-label="Search">
                        <button class="btn btn-outline-light p-1" id="but" onclick="buts()"  type="submit">Search</button>
                    </form>&nbsp; 
                </div>

            <div class="nav-item mb-3 p-2" >
                <a href="/api/admin">
                <button type="button" id="quit" class="btn btn-outline-danger mt-3 p-1 " style="display:none">
                    <img src="/image/quit.png" alt="quitter" width="30">
                </button>
            </a>
        </div>
            <a href="/api/logout">
                <button type="button" class="btn btn-outline-success "><i
                    class="fa-solid fa-arrow-right-from-bracket" style="color:white; font-size:35px; padding-top:12px;"></i>Deconnecter</button>
            </a>
        </nav>


    </header>
    <main>
        <div class="m-5">
        <table class="table caption-top border border-dark">
        <thead class="table-success">
    <tr>
     <th scope="col">Matricule</th>
      <th scope="col">NOM</th>
      <th scope="col">PRENOM</th>
      <th scope="col">E-MAIL</th>
     

      
      <th scope="col">Role</th>
{{--       <th scope="col">Role</th> --}}

      
      

      <th scope="col">ACTION</th>
      {{-- <th scope="col">Etat</th> --}}
    {{--   <th scope="col">Pass</th> --}}
    </tr>
  </thead>

  <tbody>

  @foreach ($users as $user)
    <tr>
      <td>{{{ $user->matricule }}}</td>
      <td >{{{ $user->nom }}}</td>
      <td>{{{ $user->prenom }}}</td>
      <td>{{{ $user->email }}}</td>
      <td>{{{ $user->role }}}</td>
      <td>
        <a href="/api/posts/switchRole/{{$user->id}}?post"><i class="fa-solid fa-rotate-right" style="color:red"></i></a>
        <a href="/api/posts/archiv/{{$user->id}}"><i class="fa-solid fa-box-archive "style="color: black"></i></a>
        <a href="posts/editForm/{{$user->id}}"><i class="fa-solid fa-pen-to-square "style="color: blue"></i></a>
     </td>
    </tr>
    @endforeach
  </tbody>
</table>
   <div class="pagination d-flex justify-content-center ">
         {{$users->links()}}

 {{--    function search(){
    let recherche = document.getElementById('recherche');
    let quit = document.getElementById('quit');

    if (recherche.value !=" "){
         quit.style.display = "block";

    }
    }


<div class="d-flex justify-content-center col-">
    {{ $users->links() }}
</div> --}}
</div>
</main>

</body>
</html>



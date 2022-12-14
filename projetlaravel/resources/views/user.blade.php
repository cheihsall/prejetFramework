
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


    <title>page user</title>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-success p-4">
            <div class="d-flex flex-column">
                <img src="/uploads/user/{{ $_SESSION['photo'] }}" class="rounded-circle" height="100" width="100" alt="photo" title="Photo de Profil">
                 <span class="text-light h3" title="Matricule">{{ $_SESSION['matricule'] }}</span>
            </div>
            <div class="me-5 d-flex flex-row">
                <span class="text-light h3">{{ $_SESSION['prenom'] }}</span>&nbsp;&nbsp;
                <span class="text-light h3">{{ $_SESSION['nom'] }}</span>&nbsp;

            </div>


            <div style="margin-left:50rem;max-height: 2.5rem;">

           {{-- a ne  --}}
           <div class="ml-auto  mt-3" style="margin-left:auto;max-height: 2.5rem;">
            <form style="position: relative" class="d-flex" action="search2" method="GET" role="search">
             <input style="height:36px" class="form-control me-2" name="prenom" id="recherche" value="{{ request()->prenom ?? ''}}" placeholder="Recherche par prenom"
               aria-label="Search">
             <a style=" margin-left: -38px;" href="/api/usersimple">
                     <img class="mt-1" src="/image/quit.png" alt="quitter" width="22">
             </a>
             <button style="margin-left: 15px;height:36px" class="btn btn-outline-light p-1" type="submit">rechercher</button>
          <div style="margin-bottom:2px;">
                <a href="/api/logout">
                    <button type="button" class="btn btn-outline-success mb-1"><i
                        class="fa-solid fa-arrow-right-from-bracket" style="color:white; font-size:35px; padding-top:1px; margin-bottom:2px;"></i>Deconnecter</button>
                </a>
              </div>
            </form>
</div>
     </div>

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
    @if ($users->count() > 0)
    @foreach ($users as $user)
    <tr>
      <td cope="row"><b>{{{ $user->nom }}}</b></td>
      <td><b>{{{ $user->prenom }}}</b></td>
      <td><b>{{{ $user->email }}}</b></td>
       <td><b>{{{ $user->matricule }}}</b></td>
       <td><b>{{{ $user->date_inscription = date("d-m-y")}}}</b></td>


    </tr>
    @endforeach
    @else:
      <span class="w-75 h-25 mb-2 h5 d-flex justify-content-center border-none text-danger">
        L'utilisateur recherché ne figure pas sur cette liste !
    </span>
    @endif
  </tbody>
</table>
<div class="pagination d-flex justify-content-center fixed-bottom">
    {{ $users->links() }}
</div>
</div>
</main>

</body>
</html>

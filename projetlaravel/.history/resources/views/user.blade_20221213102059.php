
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
        <nav class="navbar navbar-expand-lg bg-success p-4">
            <div class="d-flex flex-column">
                <img src="{{ $_SESSION['phot'] }}" class="rounded-circle" height="100" width="100" alt="photo">
                 <span class="text-light h3">{{ $_SESSION['matricule'] }}</span>
            </div>&nbsp;&nbsp;&nbsp;
            <div class="me-5 d-flex flex-row">
                <span class="text-light h3">{{ $_SESSION['prenom'] }}</span>&nbsp;&nbsp;
                <span class="text-light h3">{{ $_SESSION['nom'] }}</span>&nbsp;
              
            </div>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
    <form class="d-flex" action="search2" method="GET" role="search">
        <input class="form-control me-2" name="nom" type="search" placeholder="Recherche"
        required  aria-label="Search">
        <button class="btn btn-outline-light p-1" id="but" onclick="buts()"  type="submit">Search</button>
    </form>&nbsp; 
    <a href="/api/logout">
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
       <td>{{{ $user->date_inscription = date("d-m-y")}}}</td>


    </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-center col-">
    {{ $users->links() }}
</div>
</div>
</main>
</body>
</html>

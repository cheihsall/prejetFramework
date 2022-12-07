<table border="1">
    <thead>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Matricule</th>
        <th>Role</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{{ $user->nom }}}</td>
                <td>{{{ $user->prenom }}}</td>
                <td>{{{ $user->matricule }}}</td>
                <td>{{{ $user->role }}}</td>
                <td>{{{ $user->email }}}</td>
                <td>
                    <form action="/api/posts/switchRole/{{$user->id}}" method="post">
                        <button type="submit">switcher</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
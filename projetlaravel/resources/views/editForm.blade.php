<form action="/api/posts/edit/{{$user->id}}" method="post">
    <input type="text" name="nom" value="{{{ $user->nom }}}">
    <input type="submit" value="modifier" name="modifier">
</form>
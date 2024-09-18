<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @foreach($livros as $item)
        <h1>{{$item->nome}}</h1>
        <h4>{{$item->pais}}</h4>
        <h4>{{$item->editora->nome}}</h4>
        <h4>{{$item->genero->nome}}</h4>
        <hr>
    @endforeach

</body>
</html>        
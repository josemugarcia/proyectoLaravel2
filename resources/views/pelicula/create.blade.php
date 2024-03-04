<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/pelicula')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('pelicula.form',['modo'=>'Crear']);
    </form>
</body>
</html>
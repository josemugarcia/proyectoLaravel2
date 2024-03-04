<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/pelicula/'.$pelicula->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field("PATCH")}}
        @include('pelicula.form',['modo'=>'Editar']);
    </form>
</body>
</html>

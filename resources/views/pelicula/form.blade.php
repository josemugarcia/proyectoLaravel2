@extends('layouts.app')

@section('content')

<div class="container m-auto border-success">

    @if(count($errors) > 0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        
    
    @endif

    <h1 class="mb-4">{{$modo}} película</h1>
    <form action="{{ isset($pelicula) ? url('/pelicula/'.$pelicula->id) : url('/pelicula') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($pelicula))
            {{ method_field('PATCH') }}
        @endif
        <div class="mb-3">
            <label for="nombre_Pelicula" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_Pelicula" name="nombre_Pelicula" value="{{ isset($pelicula->nombre_Pelicula)?$pelicula->nombre_Pelicula:old('nombre_Pelicula') }}">
        </div>
        <div class="mb-3">
            <label for="año_lanzamiento" class="form-label">Año Lanzamiento</label>
            <input type="text" class="form-control" id="año_lanzamiento" name="año_lanzamiento" value="{{ isset($pelicula->año_lanzamiento)?$pelicula->año_lanzamiento:old('año_lanzamiento') }}">
        </div>
        <div class="mb-3">
            <label for="director" class="form-label">Director</label>
            <input type="text" class="form-control" id="director" name="director" value="{{ isset($pelicula->director)?$pelicula->director:old('director') }}">
        </div>
        <div class="mb-3">
            <label for="precio_pelicula" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio_pelicula" name="precio_pelicula" value="{{ isset($pelicula->precio_pelicula)?$pelicula->precio_pelicula:old('precio_pelicula') }}">
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            @if(isset($pelicula->imagen))
                <img src="{{ asset('storage').'/'.$pelicula->imagen }}" width="100" alt="">
            @endif
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>
        <button type="submit" class="btn btn-primary">{{ $modo }} Datos</button>
    </form>
    <a href="{{url('pelicula/')}}" class="btn btn-secondary mt-3">Regresar</a>
</div>

@endsection

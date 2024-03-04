@extends('layouts.app')

@section('content')
<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Verifica si hay un mensaje de éxito en la sesión
        @if(Session::has('mensaje'))
            // Muestra el div de éxito
            document.getElementById('success-message').style.display = 'block';
        @endif
    });
</script>
<div class="container">

    <div id="success-message" class="alert alert-success alert-dismissible" style="display: none;">
        @if(Session::has('mensaje'))
            {{ Session::get('mensaje')}}
        @endif
    </div>
    <h1 class="text-center">Listado de Pelicula</h1>
    
    <a href="{{url('pelicula/create')}}" class="btn btn-success">Añadir nueva pelicula</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Año</th>
                <th scope="col">Director</th>
                <th scope="col">Precio</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peliculas as $pelicula)
            <tr>
    
                <td>{{ $pelicula->id }}</td>
                <td>{{ $pelicula->nombre_Pelicula }}</td>
                <td>{{ $pelicula->año_lanzamiento }}</td>
                <td>{{ $pelicula->director }}</td>
                <td>{{ $pelicula->precio_pelicula }}</td>
                <td>
                    <img src="{{ asset('storage').'/'.$pelicula->imagen }}" width="100" class="img-fluid" alt="">
                </td>
                <td>
                    <a href="{{url('/pelicula/'.$pelicula->id.'/edit')}}" class="btn btn-warning">Editar</a>
                    <a href="{{url('/pelicula/'.$pelicula->id)}}" onclick="event.preventDefault(); if(confirm('¿Quieres borrar?')) { document.getElementById('delete-form-{{$pelicula->id}}').submit(); }" class="btn btn-danger">Borrar</a>
                    <form id="delete-form-{{$pelicula->id}}" action="{{url('/pelicula/'.$pelicula->id)}}" method="post" style="display: none;">
                        @csrf
                        {{method_field('DELETE')}}
                    </form>
                </td>
                
                
    
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $peliculas ->links() !!} 
    @endsection
</div>



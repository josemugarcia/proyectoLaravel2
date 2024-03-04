<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['peliculas'] = Pelicula::paginate(3);
        return view('pelicula.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pelicula.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //



        $campos = [
            'nombre_Pelicula' => 'required|string|max:100',
            'año_lanzamiento' => 'required|integer|min:1900|max:2025',
            'director' => 'required|string|max:100',
            'precio_pelicula' => 'required|string|max:10',
            'imagen' => 'required|file|image|max:10240'
        ];


        $mensaje = [
            'required' => 'El atributo :attribute es obligatorio',
            'imagen' => 'La imagen es requerida'
        ];

        $this->validate($request, $campos, $mensaje);
        // $datosPelicula = request()->all();


        $datosPelicula = request()->except('_token');

        if ($request->hasFile('imagen')) {
            $datosPelicula['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        Pelicula::insert($datosPelicula);
        //return response()->json($datosPelicula);
        return redirect('pelicula')->with('mensaje', 'Pelicula registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $pelicula = Pelicula::findOrFail($id);
        return view('pelicula.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $campos = [
            'nombre_Pelicula' => 'required|string|max:100',
            'año_lanzamiento' => 'required|integer|min:1900|max:2025',
            'director' => 'required|string|max:100',
            'precio_pelicula' => 'required|string|max:10',

        ];


        $mensaje = [
            'required' => 'El atributo :attribute es obligatorio',

        ];

        if ($request->hasFile('imagen')) {
            $campos = [

                'imagen' => 'required|file|image|max:10240'
            ];


            $mensaje = [
                'imagen' => 'La imagen es requerida'
            ];
        }

        $this->validate($request, $campos, $mensaje);
        $datosPelicula = request()->except(['_token', '_method']);
        if ($request->hasFile('imagen')) {
            $pelicula = Pelicula::findOrFail($id);
            Storage::delete('public/' . $pelicula->imagen);
            $datosPelicula['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        Pelicula::where('id', '=', $id)->update($datosPelicula);

        $pelicula = Pelicula::findOrFail($id);
        // return view('pelicula.edit', compact('pelicula'));
        return redirect('pelicula')->with('mensaje', 'Pelicula modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $pelicula = Pelicula::findOrFail($id);
        if (Storage::delete('public/' . $pelicula->imagen)) {
            Pelicula::destroy($id);
        }

        return redirect('pelicula')->with('mensaje', 'Pelicula eliminada correctamente');
    }
}

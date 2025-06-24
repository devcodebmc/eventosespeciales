<?php

namespace App\Http\Controllers;

use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventImage  $eventImage
     * @return \Illuminate\Http\Response
     */
    public function show(EventImage $eventImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventImage  $eventImage
     * @return \Illuminate\Http\Response
     */
    public function edit(EventImage $eventImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventImage  $eventImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventImage $eventImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventImage  $eventImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventImage $eventImage)
    {

        // Verificar si el usuario autenticado es el propietario del evento
        if (auth()->id() !== $eventImage->event->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado para eliminar esta imagen'
            ], 403);
        }

        try {
            // Eliminar el archivo físico (ajustado a tu estructura de almacenamiento)
            $imagePath = str_replace('/storage', 'public', $eventImage->image_path);
            
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            } else {
                // Si no existe en la ruta transformada, intentar con la ruta original
                $originalPath = str_replace('/storage', '', $eventImage->image_path);
                if (Storage::exists('public/'.$originalPath)) {
                    Storage::delete('public/'.$originalPath);
                }
            }

            // Eliminar el registro de la imagen de la base de datos
            $eventImage->delete();

            return response()->json([
                'success' => true,
                'message' => 'Imagen eliminada correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la imagen: ' . $e->getMessage()
            ], 500);
        }
    }
}

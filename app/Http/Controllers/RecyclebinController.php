<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class RecyclebinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Base query para recetas eliminadas
        $query = Event::onlyTrashed()->orderBy('deleted_at', 'DESC');        
        $events = $query->paginate(10);
        return view('recyclebin.index', compact('events'));
    }

    public function restore($id)
    {
        $event = Event::withTrashed()->where('id', $id)->first();

        if (!$event) {
            return redirect()->route('recyclebin.index')->with('error', 'Evento no encontrado');
        }
 
        $event->restore();
        return redirect()->route('event.index')->with('success', 'Evento restaurado correctamente');
    }

    public function destroy($id)
    {
        $event = Event::withTrashed()->where('id', $id)->first();

        if (!$event) {
            return redirect()->route('recyclebin.index')->with('error', 'Evento no encontrado');
        }
    
        try {
            // Desasociar etiquetas
            $event->tags()->detach();

            // Eliminar imagen principal
            if ($event->image) {
                $imagePath = str_replace('/storage', 'public', $event->image);
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            // Eliminar imágenes asociadas
            $images = $event->images;
            foreach ($images as $image) {
                $imagePath = str_replace('/storage', 'public', $image->image_path);
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
                $image->delete();
            }

            // Eliminación permanente
            $event->forceDelete();

            return redirect()->route('recyclebin.index')->with('success', 'Evento eliminado definitivamente');
        } catch (\Exception $e) {
            return redirect()->route('recyclebin.index')->with('error', 'Error al eliminar el evento: ' . $e->getMessage());
        }
    }
}
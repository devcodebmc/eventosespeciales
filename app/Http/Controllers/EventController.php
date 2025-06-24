<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
 
        // Verificar si el usuario está autenticado
       if (!auth()->check()) {
           return redirect()->route('login'); // O manejar usuarios no autenticados
       }
       
       // Base query con ordenación y búsqueda
       $query = Event::orderBy('updated_at', 'DESC')->search($search);   

       $events = $query->paginate(5);

       return view('events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name', 'asc')->get();
        $tags = Tag::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('events.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url|max:255',
            'event_images.*' => 'nullable|image|max:10240',
            'status' => 'required|in:draft,published',
            'type' => 'required|in:Event,Service,Gallery,Video,Banner,Promotion,Package,Article',
        ]);

        // Subir imagen principal si se proporciona
        $image = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $image = Storage::url($imagePath);
        }

        // Guardar el evento
        $event = Event::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'event_date' => $request->event_date,
            'location' => $request->location,
            'organizer' => $request->organizer,
            'image' => $image,
            'video_url' => $request->video_url,
            'status' => $request->status,
            'type' => $request->type,
        ]);

        // Guardar las tags (si se enviaron)
        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        // Guardar imágenes secundarias si se suben
        if ($request->hasFile('event_images')) {
            foreach ($request->file('event_images') as $key => $file) {
                $secondaryImagePath = $file->store('event_images', 'public');
                $secondaryImage = Storage::url($secondaryImagePath);

                // Suponiendo que tienes un modelo EventImage relacionado
                $event->images()->create([
                    'image_path' => $secondaryImage,
                    'order' => $key,
                ]);
            }
        }

        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    public function edit($id)
    {
        $event = Event::with(['category', 'tags', 'images'])->findOrFail($id);

        // Validar autenticación
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $categories = Category::select('id', 'name')->orderBy('name', 'asc')->get();
        $tags = Tag::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('events.edit', compact('event', 'categories', 'tags'));
    }

    public function update(Request $request, Event $event)
    {
        // Validar autenticación
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published',
            'type' => 'required|in:Event,Service,Gallery,Video,Banner,Promotion,Package,Article',
        ]);

        // Subir imagen principal si se proporciona
        $image = $event->image;
        if ($request->hasFile('image')) {
             // Eliminar la imagen anterior si existe
            if ($event->image) {
                $oldImagePath = str_replace('/storage', 'public', $event->image);
                Storage::delete($oldImagePath);
            }
            $imagePath = $request->file('image')->store('events', 'public');
            $image = Storage::url($imagePath);
        }

        // Actualizar el evento
        $event->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'organizer' => $request->organizer,
            'image' => $image,
            'video_url' => $request->video_url,
            'status' => $request->status,
            'type' => $request->type,
        ]);

        // Actualizar las tags (si se enviaron)
        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        // Actualizar las imagenes secundarias si se suben
        if ($request->hasFile('event_images')) {
            foreach ($request->file('event_images') as $key => $file) {
                $secondaryImagePath = $file->store('event_images', 'public');
                $secondaryImage = Storage::url($secondaryImagePath);

                // Suponiendo que tienes un modelo EventImage relacionado
                $event->images()->create([
                    'image_path' => $secondaryImage,
                    'order' => $key,
                ]);
            }       
        }

        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Validar autenticación
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $event = Event::findOrFail($id);

        // Validar roles y propiedad de la receta
        if ($event->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta receta.');
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento enviado a la papelera correctamente.');
    }

    public function updateStatus(Request $request, Event $event)
    {
        $validated = $request->validate([
            'new_status' => 'required|in:published,draft'
        ]);
        
        $event->update(['status' => $validated['new_status']]);
        
        return back()->with('success', 'Estado actualizado correctamente');
    }
}

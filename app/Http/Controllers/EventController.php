<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
 
        if (!auth()->check()) {
            return redirect()->route('login');
        }
       
        $events = Event::orderBy('updated_at', 'DESC')
            ->search($search)
            ->paginate(5);

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
        $validatedData = $request->validate([
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

        DB::beginTransaction();

        try {
            // Subir imagen principal si se proporciona
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = Storage::url($request->file('image')->store('events', 'public'));
            }

            // Crear el evento
            $event = Event::create([
                'title' => $validatedData['title'],
                'summary' => $validatedData['summary'],
                'content' => $validatedData['content'],
                'category_id' => $validatedData['category_id'],
                'user_id' => auth()->id(),
                'event_date' => $validatedData['event_date'],
                'location' => $validatedData['location'],
                'organizer' => $validatedData['organizer'],
                'image' => $imagePath,
                'video_url' => $validatedData['video_url'],
                'status' => $validatedData['status'],
                'type' => $validatedData['type'],
            ]);

            // Sincronizar tags
            if ($request->has('tags')) {
                $event->tags()->sync($request->tags);
            }

            // Procesar imágenes secundarias
            if ($request->hasFile('event_images')) {
                $this->processEventImages($request->file('event_images'), $event);
            }

            DB::commit();

            return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear evento: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al crear el evento. Por favor, inténtelo de nuevo.');
        }
    }

    public function edit($id)
    {
        $event = Event::with(['category', 'tags', 'images'])->findOrFail($id);

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $categories = Category::select('id', 'name')->orderBy('name', 'asc')->get();
        $tags = Tag::select('id', 'name')->orderBy('name', 'asc')->get();
        
        return view('events.edit', compact('event', 'categories', 'tags'));
    }

    public function update(Request $request, Event $event)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $validatedData = $request->validate([
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

        DB::beginTransaction();

        try {
            // Procesar imagen principal
            $imagePath = $event->image;
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior si existe
                if ($event->image) {
                    $this->deleteImage($event->image);
                }
                $imagePath = Storage::url($request->file('image')->store('events', 'public'));
            }

            // Actualizar el evento
            $event->update([
                'title' => $validatedData['title'],
                'summary' => $validatedData['summary'],
                'content' => $validatedData['content'],
                'category_id' => $validatedData['category_id'],
                'event_date' => $validatedData['event_date'],
                'location' => $validatedData['location'],
                'organizer' => $validatedData['organizer'],
                'image' => $imagePath,
                'video_url' => $validatedData['video_url'],
                'status' => $validatedData['status'],
                'type' => $validatedData['type'],
            ]);

            // Sincronizar tags
            if ($request->has('tags')) {
                $event->tags()->sync($request->tags);
            }

            // Procesar imágenes secundarias
            if ($request->hasFile('event_images')) {
                $this->processEventImages($request->file('event_images'), $event);
            }

            DB::commit();

            return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar evento: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar el evento. Por favor, inténtelo de nuevo.');
        }
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $event = Event::findOrFail($id);

        if ($event->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este evento.');
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

    /**
     * Procesa y guarda las imágenes secundarias del evento
     */
    protected function processEventImages($images, Event $event)
    {
        foreach ($images as $key => $file) {
            $secondaryImagePath = Storage::url($file->store('event_images', 'public'));
            
            $event->images()->create([
                'image_path' => $secondaryImagePath,
                'order' => $key,
            ]);
        }
    }

    /**
     * Elimina una imagen del almacenamiento
     */
    protected function deleteImage($imageUrl)
    {
        $path = str_replace('/storage', 'public', $imageUrl);
        Storage::delete($path);
    }
}
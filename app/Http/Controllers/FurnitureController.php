<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $furnitures = Furniture::OrderBy('updated_at', 'DESC')->search($search)->paginate(5);
        $services = Service::select('id', 'name')->get();
        return view('furnitures.index', compact('furnitures', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::select('id', 'name')->get();
        return view('furnitures.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable', 'in:published,draft'],
            'order' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'service_id' => ['nullable', 'exists:services,id'],
        ]);

        // Create a new service
        $furniture               = new Furniture();
        $furniture->name         = $request->name;
        $furniture->description  = $request->description;
        $furniture->status       = $request->status ?? 'draft';
        $furniture->order        = $request->order ?? 0;
        $furniture->service_id   = $request->service_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('furnitures', 'public');
            $furniture->image = $imagePath;
        }

        $furniture->save();

        return redirect()->route('furnitures.index')->with('success', 'Mobiliario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function show(Furniture $furniture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $furniture = Furniture::findorFail($id);
        $orderLimit = Furniture::count(); // Limit for order field
        $services = Service::select('id', 'name')->get();
        return view('furnitures.edit', compact('furniture', 'orderLimit', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable', 'in:published,draft'],
            'order' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'service_id' => ['nullable', 'exists:services,id'],
        ]);

        // Update the specified service
        $furniture = Furniture::findOrFail($id);
        $oldOrder = $furniture->order;
        $newOrder = $request->order ?? $furniture->order;

        $furniture->name = $request->name;
        $furniture->description = $request->description;
        $furniture->status = $request->status ?? $furniture->status;
        $furniture->order = $newOrder;

        // Handle image upload and delete previous image if replaced
        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($furniture->image && Storage::disk('public')->exists($furniture->image)) {
                Storage::disk('public')->delete($furniture->image);
            }
            $imagePath = $request->file('image')->store('furnitures', 'public');
            $furniture->image = $imagePath;
        }

        $furniture->updated_at = now();
        $furniture->save();

        // Si el order se actualizó y otro mobiliario ya lo tenía, reasignar el order anterior
        if ($newOrder != $oldOrder) {
            $otherFurniture = Furniture::where('order', $newOrder)
                ->where('id', '!=', $furniture->id)
                ->first();
            if ($otherFurniture) {
                $otherFurniture->order = $oldOrder;
                $otherFurniture->save();
            }
        }

        return redirect()->route('furnitures.index')->with('success', 'Mobiliario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $furniture = Furniture::findOrFail($id);

        // Delete image if exists
        if ($furniture->image && Storage::disk('public')->exists($furniture->image)) {
            Storage::disk('public')->delete($furniture->image);
        }

        $furniture->delete();

        return redirect()->route('furnitures.index')->with('success', 'Mobiliario eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $services = Service::OrderBy('updated_at', 'DESC')->search($search)->paginate(5);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
        ]);

        // Create a new service
        $service               = new Service;
        $service->name         = $request->name;
        $service->description  = $request->description;
        $service->status       = $request->status ?? 'draft';

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Servicio creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findorFail($id);
        $orderLimit = Service::count(); // Limit for order field
        return view('services.edit', compact('service', 'orderLimit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
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
        ]);

        // Update the specified service
        $service = Service::findOrFail($id);
        $oldOrder = $service->order;
        $newOrder = $request->order ?? $service->order;

        $service->name = $request->name;
        $service->description = $request->description;
        $service->status = $request->status ?? $service->status;
        $service->order = $newOrder;

        // Handle image upload and delete previous image if replaced
        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }

        $service->updated_at = now();
        $service->save();

        // Si el order se actualizó y otro servicio ya lo tenía, reasignar el order anterior
        if ($newOrder != $oldOrder) {
            $otherService = Service::where('order', $newOrder)
                ->where('id', '!=', $service->id)
                ->first();
            if ($otherService) {
                $otherService->order = $oldOrder;
                $otherService->save();
            }
        }

        return redirect()->route('services.index')->with('success', 'Servicio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // Delete image if exists
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Servicio eliminado correctamente.');
    }
}

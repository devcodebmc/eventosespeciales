<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

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
        return view('content.create');
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
            'name' => ['required', 'string', 'max:255']
        ]);

        // Create a new service
        $service               = new Service;
        $service->name         = $request->name;
        $service->description  = $request->description;
        $service->save();

        // Redirect to the services index
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
        return view('services.edit', compact('service'));
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
            'name' => ['required','string','max:255']
        ]);

        // Update the specified service
        $service                = Service::find($id);
        $service->name          = $request->name;
        $service->description   = $request->description;
        $service->updated_at    = now();
        $service->save();

        // Redirect to the categories index
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
        Service::destroy($id);
        return redirect()->route('services.index')->with('success', 'Servicio eliminado correctamente.');
    }
}

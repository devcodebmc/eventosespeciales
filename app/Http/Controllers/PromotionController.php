<?php

namespace App\Http\Controllers;

use App\Models\Promotion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $promotions = Promotion::OrderBy('updated_at', 'DESC')->search($search)->paginate(5);
        return view('promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentOrder = Promotion::max('order') ?? 0;
        return view('promotions.create', compact('currentOrder'));
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:discount,banner,popup'],
            'order' => ['nullable', 'integer'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'image' => ['nullable', 'image', 'max:5120'], // 5MB max
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Create a new promotion
        $promotion               = new Promotion;
        $promotion->title       = $request->title;
        $promotion->description = $request->description;
        $promotion->type        = $request->type;
        $promotion->order       = $request->order ?? 0;
        $promotion->starts_at   = $request->starts_at;
        $promotion->ends_at     = $request->ends_at;
        $promotion->is_active   = $request->is_active ?? 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('promotions', 'public');
            $promotion->image = $imagePath;
        }

        $promotion->save();

        return redirect()->route('promotions.index')->with('success', 'Promoción creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $promotion = Promotion::where('slug', $slug)->firstOrFail();
        return view('promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $orderLimit = Promotion::count(); // Limit for order field
        return view('promotions.edit', compact('promotion' , 'orderLimit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:discount,banner,popup'],
            'order' => ['nullable', 'integer'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'image' => ['nullable', 'image', 'max:5120'], // 5MB max
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Find the promotion
        $promotion = Promotion::findOrFail($id);

        $oldOrder = $promotion->order;
        $newOrder = $request->order ?? $oldOrder;

        // Ajustar el orden solo si cambia y es diferente al actual
        if ($newOrder != $oldOrder) {
            if ($newOrder > $oldOrder) {
            // Mover hacia abajo: los que están entre oldOrder+1 y newOrder bajan uno
            Promotion::where('order', '>', $oldOrder)
                ->where('order', '<=', $newOrder)
                ->decrement('order');
            } else {
            // Mover hacia arriba: los que están entre newOrder y oldOrder-1 suben uno
            Promotion::where('order', '>=', $newOrder)
                ->where('order', '<', $oldOrder)
                ->increment('order');
            }
            $promotion->order = $newOrder;
        }

        $promotion->title       = $request->title;
        $promotion->description = $request->description;
        $promotion->type        = $request->type;
        $promotion->starts_at   = $request->starts_at;
        $promotion->ends_at     = $request->ends_at;
        $promotion->is_active   = $request->is_active ?? 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($promotion->image) {
                Storage::disk('public')->delete($promotion->image);
            }
            $imagePath = $request->file('image')->store('promotions', 'public');
            $promotion->image = $imagePath;
        }

        $promotion->save();

        return redirect()->route('promotions.index')->with('success', 'Promoción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);

        // Delete image if exists
        if ($promotion->image) {
            Storage::disk('public')->delete($promotion->image);
        }
        
        $promotion->delete();
        return redirect()->route('promotions.index')->with('success', 'Promoción eliminada exitosamente.');
    }
}

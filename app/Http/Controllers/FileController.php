<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');

        // Ordenamiento seguro
        $sortable = ['name', 'size', 'type', 'updated_at', 'created_at'];
        $sort = in_array($request->input('sort'), $sortable, true) ? $request->input('sort') : 'updated_at';
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';

        $query = File::with('category')->search($search);

        if ($status === 'active') {
            $query->whereNull('deleted_at');
        } elseif ($status === 'trashed') {
            $query->onlyTrashed();
        } else {
            $query->withTrashed();
        }

        $files = $query
            ->orderByRaw('deleted_at IS NOT NULL ASC')
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('files.index', compact('files', 'status', 'sort', 'direction'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('files.create', compact('categories'));
    }

    public function store(FileRequest $request)
    {
        $data = $request->validated();
        $uploaded = $request->file('file');

        $path = $uploaded->store('files/' . now()->format('Y/m'), 'public');

        File::create([
            'name'          => $data['name'],
            'type'          => $data['type'],
            'category_id'   => $data['category_id'],
            'file'          => $path,
            'size'          => $uploaded->getSize(),
            'mime_type'     => $uploaded->getClientMimeType(),
            'original_name' => $uploaded->getClientOriginalName(),
        ]);

        return redirect()->route('files.index')->with('success', 'Archivo subido correctamente.');
    }

    public function edit(File $file)
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('files.edit', compact('file', 'categories'));
    }

    public function update(FileRequest $request, File $file)
    {
        $data = $request->validated();

        $payload = [
            'name'        => $data['name'],
            'type'        => $data['type'],
            'category_id' => $data['category_id'],
        ];

        if ($request->hasFile('file')) {
            $uploaded = $request->file('file');
            $newPath = $uploaded->store('files/' . now()->format('Y/m'), 'public');

            if ($file->file && Storage::disk('public')->exists($file->file)) {
                Storage::disk('public')->delete($file->file);
            }

            $payload += [
                'file'          => $newPath,
                'size'          => $uploaded->getSize(),
                'mime_type'     => $uploaded->getClientMimeType(),
                'original_name' => $uploaded->getClientOriginalName(),
            ];
        }

        $file->update($payload);

        return redirect()->route('files.index')->with('success', 'Archivo actualizado correctamente.');
    }

    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->route('files.index')->with('success', 'Archivo movido a la papelera.');
    }

    public function restore($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();
        return redirect()->route('files.index')->with('success', 'Archivo restaurado correctamente.');
    }

    public function forceDestroy($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->forceDelete();
        return redirect()->route('files.index')->with('success', 'Archivo eliminado permanentemente.');
    }

    public function download($id)
    {
        $file = File::withTrashed()->findOrFail($id);

        abort_unless(
            $file->file && Storage::disk('public')->exists($file->file),
            404,
            'Archivo no encontrado.'
        );

        return Storage::disk('public')->download(
            $file->file,
            $file->original_name ?: basename($file->file)
        );
    }
}
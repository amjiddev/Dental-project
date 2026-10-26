<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::orderBy('order', 'asc')->paginate(10);
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = ImageUploadService::upload($request->file('image'), 'gallery');
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item created successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                ImageUploadService::delete($gallery->image);
            }

            $validated['image'] = ImageUploadService::upload($request->file('image'), 'gallery');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if ($gallery->image) {
            ImageUploadService::delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update([
            'is_active' => !$gallery->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $gallery->is_active,
            'message' => $gallery->is_active ? 'Item activated' : 'Item deactivated'
        ]);
    }
}

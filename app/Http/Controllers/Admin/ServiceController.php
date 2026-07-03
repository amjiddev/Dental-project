<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'key_highlights' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated = $this->processPageContentFields($request, $validated);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/services'), $imageName);
            $validated['image'] = 'uploads/services/' . $imageName;
        }

        $service = Service::create($validated);

        return redirect()->route('admin.services.treatment-options.index', $service)
            ->with('success', 'Service created successfully. You can now add treatment options.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'key_highlights' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated = $this->processPageContentFields($request, $validated);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/services'), $imageName);
            $validated['image'] = 'uploads/services/' . $imageName;
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus(Service $service)
    {
        $service->update([
            'is_active' => !$service->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $service->is_active,
        ]);
    }

    private function processPageContentFields(Request $request, array $validated): array
    {
        if (!empty($validated['key_highlights'])) {
            $lines = array_filter(array_map('trim', preg_split('/\r?\n/', $validated['key_highlights'])));
            $validated['key_highlights'] = array_values($lines);
        } else {
            $validated['key_highlights'] = [];
        }

        $whyChoose = [];
        for ($i = 1; $i <= 4; $i++) {
            $title = trim((string) $request->input("why_choose_{$i}_title", ''));
            $description = trim((string) $request->input("why_choose_{$i}_description", ''));
            $icon = trim((string) $request->input("why_choose_{$i}_icon", ''));

            if ($title || $description || $icon) {
                $whyChoose[] = [
                    'icon' => $icon,
                    'title' => $title,
                    'description' => $description,
                ];
            }
        }

        $validated['why_choose_features'] = $whyChoose;

        return $validated;
    }
}

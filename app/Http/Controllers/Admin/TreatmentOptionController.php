<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\TreatmentOption;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class TreatmentOptionController extends Controller
{
    public function index(Service $service)
    {
        $treatmentOptions = $service->treatmentOptions()->paginate(10);

        return view('admin.treatment-options.index', compact('service', 'treatmentOptions'));
    }

    public function create(Service $service)
    {
        return view('admin.treatment-options.create', compact('service'));
    }

    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $validated['image'] = ImageUploadService::upload($request->file('image'), 'treatment-options');
        }

        $service->treatmentOptions()->create($validated);

        return redirect()->route('admin.services.treatment-options.index', $service)
            ->with('success', 'Treatment option added successfully.');
    }

    public function edit(Service $service, TreatmentOption $treatmentOption)
    {
        return view('admin.treatment-options.edit', compact('service', 'treatmentOption'));
    }

    public function update(Request $request, Service $service, TreatmentOption $treatmentOption)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($treatmentOption->image) {
                ImageUploadService::delete($treatmentOption->image);
            }

            $validated['image'] = ImageUploadService::upload($request->file('image'), 'treatment-options');
        }

        $treatmentOption->update($validated);

        return redirect()->route('admin.services.treatment-options.index', $service)
            ->with('success', 'Treatment option updated successfully.');
    }

    public function destroy(Service $service, TreatmentOption $treatmentOption)
    {
        if ($treatmentOption->image) {
            ImageUploadService::delete($treatmentOption->image);
        }

        $treatmentOption->delete();

        return redirect()->route('admin.services.treatment-options.index', $service)
            ->with('success', 'Treatment option deleted successfully.');
    }

    public function toggleStatus(Service $service, TreatmentOption $treatmentOption)
    {
        $treatmentOption->update([
            'is_active' => !$treatmentOption->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $treatmentOption->is_active,
        ]);
    }
}

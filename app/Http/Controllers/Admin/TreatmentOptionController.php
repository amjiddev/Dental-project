<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\TreatmentOption;
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
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $uploadPath = public_path('uploads/treatment-options');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);
            $validated['image'] = 'uploads/treatment-options/' . $imageName;
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
            if ($treatmentOption->image && file_exists(public_path($treatmentOption->image))) {
                unlink(public_path($treatmentOption->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $uploadPath = public_path('uploads/treatment-options');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);
            $validated['image'] = 'uploads/treatment-options/' . $imageName;
        }

        $treatmentOption->update($validated);

        return redirect()->route('admin.services.treatment-options.index', $service)
            ->with('success', 'Treatment option updated successfully.');
    }

    public function destroy(Service $service, TreatmentOption $treatmentOption)
    {
        if ($treatmentOption->image && file_exists(public_path($treatmentOption->image))) {
            unlink(public_path($treatmentOption->image));
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

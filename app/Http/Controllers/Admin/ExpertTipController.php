<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpertTip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpertTipController extends Controller
{
    public function index()
    {
        $tips = ExpertTip::orderBy('order', 'asc')->paginate(10);
        return view('admin.expert-tips.index', compact('tips'));
    }

    public function create()
    {
        return view('admin.expert-tips.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/expert-tips'), $imageName);
            $validated['image'] = 'uploads/expert-tips/' . $imageName;
        }

        ExpertTip::create($validated);

        return redirect()->route('admin.expert-tips.index')
            ->with('success', 'Expert tip created successfully.');
    }

    public function edit(ExpertTip $expertTip)
    {
        return view('admin.expert-tips.edit', compact('expertTip'));
    }

    public function update(Request $request, ExpertTip $expertTip)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($expertTip->image && file_exists(public_path($expertTip->image))) {
                unlink(public_path($expertTip->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/expert-tips'), $imageName);
            $validated['image'] = 'uploads/expert-tips/' . $imageName;
        }

        $expertTip->update($validated);

        return redirect()->route('admin.expert-tips.index')
            ->with('success', 'Expert tip updated successfully.');
    }

    public function destroy(ExpertTip $expertTip)
    {
        // Delete image
        if ($expertTip->image && file_exists(public_path($expertTip->image))) {
            unlink(public_path($expertTip->image));
        }

        $expertTip->delete();

        return redirect()->route('admin.expert-tips.index')
            ->with('success', 'Expert tip deleted successfully.');
    }

    public function toggleStatus(ExpertTip $expertTip)
    {
        $expertTip->update([
            'is_active' => !$expertTip->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $expertTip->is_active,
        ]);
    }
}

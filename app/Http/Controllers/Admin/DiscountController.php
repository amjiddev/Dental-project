<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::orderBy('discount_percentage', 'desc')->paginate(10);
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'color' => 'required|string',
            'benefits' => 'nullable|string',
            'button_label' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        if (!empty($validated['benefits'])) {
            $lines = array_filter(array_map('trim', preg_split('/\r?\n/', $validated['benefits'])));
            $validated['benefits'] = array_values($lines);
        } else {
            $validated['benefits'] = [];
        }

        Discount::create($validated);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'color' => 'required|string',
            'benefits' => 'nullable|string',
            'button_label' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        if (!empty($validated['benefits'])) {
            $lines = array_filter(array_map('trim', preg_split('/\r?\n/', $validated['benefits'])));
            $validated['benefits'] = array_values($lines);
        } else {
            $validated['benefits'] = [];
        }

        $discount->update($validated);

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount deleted successfully.');
    }

    public function toggleStatus(Discount $discount)
    {
        $discount->update([
            'is_active' => !$discount->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $discount->is_active,
        ]);
    }
}

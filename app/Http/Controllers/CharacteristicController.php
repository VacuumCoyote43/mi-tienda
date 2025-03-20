<?php

namespace App\Http\Controllers;

use App\Models\Characteristic;
use Illuminate\Http\Request;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Characteristic::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $characteristics = $query->latest()->paginate(10)->withQueryString();
        return view('modules.characteristic.index', compact('characteristics', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.characteristic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:'.implode(',', Characteristic::TYPES),
            'value' => 'nullable|string|max:255'
        ]);

        Characteristic::create($validated);

        return redirect()->route('admin.characteristic.index')
            ->with('success', 'Característica creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Characteristic $characteristic)
    {
        return view('modules.characteristic.show', compact('characteristic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Characteristic $characteristic)
    {
        return view('modules.characteristic.edit', compact('characteristic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Characteristic $characteristic)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:'.implode(',', Characteristic::TYPES),
            'value' => 'nullable|string|max:255'
        ]);

        $characteristic->update($validated);

        return redirect()->route('admin.characteristic.index')
            ->with('success', 'Característica actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Characteristic $characteristic)
    {
        $characteristic->delete();

        return redirect()->route('admin.characteristic.index')
            ->with('success', 'Característica eliminada exitosamente.');
    }
}

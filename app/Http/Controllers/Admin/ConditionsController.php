<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    public function index()
    {
        $conditions = Condition::orderBy('created_at', 'desc')->paginate(6);

        return view('admin.conditions.index', compact('conditions'));
    }

    public function create()
    {
        return view('admin.conditions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|min:3|max:255|unique:conditions,key',
            'name' => 'required|string|min:3|max:255|unique:conditions,name',
            'enabled' => 'nullable|boolean',
        ]);

        Condition::create([
            'key' => $validated['key'],
            'name' => $validated['name'],
            'enabled' => $request->has('enabled') ? true : false,
        ]);

        return redirect()->route('admin.conditions.index')
            ->with('success', 'Condición agregada correctamente');
    }

    public function edit($id)
    {
        $condition = Condition::findOrFail($id);

        return view('admin.conditions.edit', compact('condition'));
    }

    public function update(Request $request, $id)
    {
        $condition = Condition::findOrFail($id);

        $request->validate([
            'key' => 'required|string|min:3|max:255|unique:conditions,key,' . $id,
            'name' => 'required|string|min:3|max:255|unique:conditions,name,' . $id,
            'enabled' => 'boolean',
        ]);

        $condition->update([
            'key' => $request->key,
            'name' => $request->name,
            'enabled' => $request->has('enabled') ? true : false,
        ]);

        return redirect()->route('admin.conditions.index')
            ->with('success', 'Condición actualizada correctamente');
    }

    public function delete($id)
    {
        $condition = Condition::findOrFail($id);

        return view('admin.conditions.delete', compact('condition'));
    }

    public function destroy($id)
    {
        $condition = Condition::findOrFail($id);

        if ($condition->projects()->count() > 0) {
            return redirect()->route('admin.conditions.index')
                ->with('error', 'No se puede eliminar la condición porque está siendo utilizada por uno o más proyectos.');
        }

        $condition->delete();

        return redirect()->route('admin.conditions.index')
            ->with('success', 'Condición eliminada correctamente');
    }
}

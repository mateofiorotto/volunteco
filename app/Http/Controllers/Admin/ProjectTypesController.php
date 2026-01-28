<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectTypesController extends Controller
{
    public function index()
    {
        $projectTypes = ProjectType::orderBy('created_at', 'desc')->paginate(6);

        return view('admin.project-types.index', compact('projectTypes'));
    }

    public function create()
    {
        return view('admin.project-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|min:3|max:255|unique:project_types,key',
            'name' => 'required|string|min:3|max:255|unique:project_types,name',
            'enabled' => 'nullable|boolean',
        ]);

        ProjectType::create([
            'key' => $validated['key'],
            'name' => $validated['name'],
            'enabled' => $request->has('enabled') ? true : false,
        ]);

        return redirect()->route('admin.project-types.index')
            ->with('success', 'Tipo de proyecto agregado correctamente');
    }

    public function edit($id)
    {
        $projectType = ProjectType::findOrFail($id);

        return view('admin.project-types.edit', compact('projectType'));
    }

    public function update(Request $request, $id)
    {
        $projectType = ProjectType::findOrFail($id);

        $request->validate([
            'key' => 'required|string|min:3|max:255|unique:project_types,key,' . $id,
            'name' => 'required|string|min:3|max:255|unique:project_types,name,' . $id,
            'enabled' => 'boolean',
        ]);

        $projectType->update([
            'key' => $request->key,
            'name' => $request->name,
            'enabled' => $request->has('enabled') ? true : false,
        ]);

        return redirect()->route('admin.project-types.index')
            ->with('success', 'Tipo de proyecto actualizado correctamente');
    }

    public function delete($id)
    {
        $projectType = ProjectType::findOrFail($id);

        return view('admin.project-types.delete', compact('projectType'));
    }

    public function destroy($id)
    {
        $projectType = ProjectType::findOrFail($id);

        if ($projectType->projects()->count() > 0) {
            return redirect()->route('admin.project-types.index')
                ->with('error', 'No se puede eliminar el tipo de proyecto porque está siendo utilizado por uno o más proyectos.');
        }

        $projectType->delete();

        return redirect()->route('admin.project-types.index')
            ->with('success', 'Tipo de proyecto eliminado correctamente');
    }
}

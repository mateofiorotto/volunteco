<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectType;
use App\Models\Condition;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Mail\VolunteerAccepted;
use App\Models\Province;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Storage;

class HostProjectController extends Controller
{
    /**
     * Mostrar lista de proyectos propios del anfitrion
     */
    public function index()
    {
        $host = Auth::user()->host;
        //obtener los proyectos, con sus tipos y condiciones (en caso de usarse)
        $projects = $host->projects()
            ->with(['projectType', 'conditions'])
            ->latest()
            ->paginate(6);

        return view('user.host.projects.index', compact('projects'));
    }

    /**
     * Mostrar detalles de un proyecto PROPIO por id
     */
    public function show($id)
    {

        $project = Project::with(['projectType', 'conditions', 'location.province'])->findOrFail($id);

        //voluntarios registrados
        $registeredVolunteers = $project->registeredVolunteers();

        return view('user.host.projects.show', compact('project', 'registeredVolunteers'));
    }

    /**
     * Mostrar formulario de creación de proyecto
     */
    public function create()
    {
        $provinces = Province::with('locations')->get();

        //solo traer tipos de proyecto habilitados
        $projectTypes = ProjectType::where('enabled', true)
            ->orderBy('name', 'asc')
            ->get();

        //solo traer condiciones habilitadas
        $conditions = Condition::where('enabled', true)
            ->orderBy('name', 'asc')
            ->get();

        return view('user.host.projects.create', compact('projectTypes', 'conditions', 'provinces'));
    }

    /**
     * Guardar nuevo proyecto
     */
    public function store(Request $request)
    {
        $host = Auth::user()->host;

        $validated = $request->validate([
            'title' => 'required|string|max:255|min:5|max:255',
            'description' => 'required|string|min:50|max:2000',
            'project_type_id' => 'required|exists:project_types,id',
            'location_id' => ['required', 'exists:locations,id'],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'work_hours_per_day' => 'required|in:2 Horas,4 Horas,6 Horas,8 Horas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:300|dimensions:max_width=860,max_height=480',
            'conditions' => 'nullable|array',
            'conditions.*' => 'exists:conditions,id'
        ]);

        //asignar el host_id del anfitrión autenticado
        $validated['host_id'] = $host->id;
        $validated['enabled'] = $request->boolean('enabled');

        //manejo de la imagen
        $validated['image'] = $request->hasFile('image')
            ? $request->file('image')->store('projects', 'public') :
            null;

        //crear el proyecto
        $project = Project::create($validated);

        // Asociar condiciones si las hay
        $project->conditions()->sync($request->input('conditions', []));

        return redirect()
            ->route('host.my-projects.index')
            ->with('success', 'Proyecto creado exitosamente');
    }

    /**
     * Mostrar formulario de edición de proyecto PROPIO
     */
    public function edit($id)
    {
        $provinces = Province::with('locations')->get();

        $host = Auth::user()->host;

        $project = $host->projects()
                ->with('location.province')
                ->findOrFail($id);

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        //solo traer tipos de proyecto habilitados
        $projectTypes = ProjectType::where('enabled', true)
            ->orderBy('name', 'asc')
            ->get();

        //solo traer condiciones habilitadas
        $conditions = Condition::where('enabled', true)
            ->orderBy('name', 'asc')
            ->get();

        return view('user.host.projects.edit', compact('project', 'projectTypes', 'conditions', 'provinces'));
    }

    /**
     * Actualizar proyecto
     */
    public function update(Request $request, $id)
    {

        $project = Project::findOrFail($id);

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $validated = $request->validate([
            'title' => ['required','string','min:5','max:255'],
            'description' => 'required|string|min:50|max:2000',
            'project_type_id' => 'required|exists:project_types,id',
            'location_id' => ['required', 'exists:locations,id'],
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after:start_date',
            'work_hours_per_day' => 'required|in:2 Horas,4 Horas,6 Horas,8 Horas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:300|dimensions:max_width=854,max_height=480',
            'conditions' => 'nullable|array',
            'conditions.*' => 'exists:conditions,id'
        ]);

        $validated['enabled'] = $request->boolean('enabled');

        //manejo de la imagen
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }


        $project->update($validated);

        // Sincronizar condiciones
        $project->conditions()->sync($request->input('conditions', []));

        return redirect()
            ->route('host.my-projects.index')
            ->with('success', 'Proyecto actualizado exitosamente');
    }

    /**
     * Deshabilitar proyecto
     */
    public function updateEnabled(Request $request, $id)
    {

        $project = Project::findOrFail($id);
        $data = $request->validate([
            'enabled' => 'sometimes|boolean',
        ]);
        $project->enabled = $request->boolean('enabled');
        $project->save();

        return redirect()->back()->with('success', 'Estado del proyecto actualizado.');
    }


    /**
     * Mostrar vista de confirmación de eliminación de proyecto PROPIO
     */
    public function delete($id)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $id)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        return view('user.host.projects.delete', compact('project'));
    }

    /**
     * Eliminar proyecto PROPIO
     */
    public function destroy($id)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $id)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        // Eliminar imagen asociada si no es la predeterminada
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('host.my-projects.index')
            ->with('success', 'Proyecto eliminado exitosamente');
    }

}

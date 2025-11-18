<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectType;
use App\Models\Condition;
use App\Services\ImageService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Mail\VolunteerAccepted;
use App\Models\Province;
use App\Models\Volunteer;

class HostProjectController extends Controller
{

    //inyectar el servicio de manejo de imagenes
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

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

        $project = Project::with(['projectType', 'conditions', 'volunteers.user'])->findOrFail($id);

        //voluntarios registrados
        $registeredVolunteers = $project->volunteers->sortByDesc(function($v) {
            return $v->pivot->applied_at;
        });

        return view('user.host.projects.show', compact('project', 'registeredVolunteers'));
    }

    /**
     * Mostrar formulario de creación de proyecto
     */
    public function create()
    {
        $provinces = Province::with('locations')->get();

        $projectTypes = ProjectType::all();
        $conditions = Condition::all();

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
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after:start_date',
            'work_hours_per_day' => 'required|in:2 Horas,4 Horas,6 Horas,8 Horas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:300|dimensions:max_width=860,max_height=480',
            'conditions' => 'nullable|array',
            'conditions.*' => 'exists:conditions,id'
        ]);

        //asignar el host_id del anfitrión autenticado
        $validated['host_id'] = $host->id;
        $validated['enabled'] = $request->has('enabled');

        //manejo de la imagen
        $validatedHost['image'] = $request->hasFile('image')
            ? $this->imageService->storeImage($request->file('image'), 'projects') :
            null;

        //crear el proyecto
        $project = Project::create($validated);

        // Asociar condiciones si las hay
        if ($request->has('conditions')) {
            $project->conditions()->attach($request->conditions);
        }

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

        $projectTypes = ProjectType::all();
        $conditions = Condition::all();

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

        $validated['enabled'] = $request->has('enabled');

        //manejo de la imagen
        if ($request->hasFile('image')) {
            $validated['image'] = $this->imageService->storeImage($request->file('image'), 'projects');
        }

        $project->update($validated);

        // Sincronizar condiciones
        if ($request->has('conditions')) {
            $project->conditions()->sync($request->conditions);
        } else {
            $project->conditions()->detach();
        }

        return redirect()
            ->route('host.my-projects.index')
            ->with('success', 'Proyecto actualizado exitosamente');
    }

    /**
     * Deshabilitar proyecto
     */
    public function updateEnabled(Request $request, $id) {

        $project = Project::findOrFail($id);
        $data = $request->validate([
            'enabled' => 'sometimes|boolean',
        ]);
        $project->enabled = $request->has('enabled') ? 1 : 0;
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
            $this->imageService->deleteImage($project->image);
        }

        $project->delete();

        return redirect()
            ->route('host.my-projects.index')
            ->with('success', 'Proyecto eliminado exitosamente');
    }

    /**
     * Aceptar voluntario en un proyecto
     */
    public function acceptVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $volunteer = $project->volunteers()
            ->with('user')
            ->where('volunteers.id', $volunteerId)
            ->first();

        if (!$volunteer) {
            abort(404, 'Voluntario no encontrado.');
        }

        $project->volunteers()->updateExistingPivot($volunteerId, [
            'status' => 'aceptado',
            'accepted_at' => now(),
        ]);

        Mail::to($volunteer->user->email)->send(
            new VolunteerAccepted($volunteer->full_name, $project->title)
        );

        return redirect()->back()->with('success', 'Voluntario aceptado exitosamente.');
    }

    /**
     * Rechazar un voluntario de un proyecto
     */
    public function rejectVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        //validar que exista el voluntario en este proyecto
        $volunteer = $project->volunteers()
            ->where('volunteers.id', $volunteerId)
            ->first();

        if (!$volunteer) {
            abort(404, 'Voluntario no encontrado en este proyecto.');
        }

        $project->volunteers()->updateExistingPivot($volunteerId, [
            'status' => 'rechazado',
        ]);

        return redirect()->back()->with('success', 'Voluntario rechazado exitosamente.');
    }
}

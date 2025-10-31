<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectType;
use App\Models\Condition;
use App\Services\ImageService;
use Illuminate\Validation\Rule;

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
     * Mostrar lista de proyectos propios del anfitrión
     */
    public function index()
    {
        $host = Auth::user()->host;
        //obtener los proyectos, con sus tipos y condiciones (en caso de usarse)
        $projects = $host->projects()
            ->with(['projectType', 'conditions'])
            ->latest()
            ->paginate(10);

        return view('user.host.projects.index', compact('projects'));
    }

    /**
     * Mostrar detalles de un proyecto PROPIO por id
     */
    public function show($id)
    {
        $host = Auth::user()->host;

        $project = Project::with(['projectType', 'conditions', 'host'])
            ->where('id', $id)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $registeredVolunteers = $project->volunteers()
            ->with('user')
            ->wherePivotIn('status', ['pendiente', 'aceptado', 'rechazado'])
            ->orderByPivot('applied_at', 'desc')
            ->get();

        return view('user.host.projects.show', compact('project', 'registeredVolunteers'));
    }

    /**
     * Mostrar formulario de creación de proyecto
     */
    public function create()
    {

        $projectTypes = ProjectType::all();
        $conditions = Condition::all();

        return view('user.host.projects.create', compact('projectTypes', 'conditions'));
    }

    /**
     * Guardar nuevo proyecto
     */
    public function store(Request $request)
    {
        $host = Auth::user()->host;

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:projects,title|min:5|max:255',
            'description' => 'required|string|min:50|max:2000',
            'project_type_id' => 'required|exists:project_types,id',
            'location' => 'required|string|min:3|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'work_hours_per_day' => 'required|in:2 Horas,4 Horas,6 Horas,8 Horas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,WebP|max:300|dimensions:min_width=304,min_height=228,max_width=854,max_height=480',
            'conditions' => 'nullable|array',
            'conditions.*' => 'exists:conditions,id'
        ]);

        //asignar el host_id del anfitrión autenticado
        $validated['host_id'] = $host->id;
        $validated['enabled'] = $request->has('enabled');

        //manejo de la imagen
        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->storeImage($request->file('image'), 'projects');
        } else {
            $imagePath = 'logo-horizontal.svg';
        }

        $validated['image'] = $imagePath;

        $project = Project::create($validated);

        // Asociar condiciones si las hay
        if ($request->has('conditions')) {
            $project->conditions()->attach($request->conditions);
        }

        return redirect()
            ->route('anfitriones.my-projects.index')
            ->with('success', 'Proyecto creado exitosamente');
    }

    /**
     * Mostrar formulario de edición de proyecto PROPIO
     */
    public function edit($id)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $id)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $projectTypes = ProjectType::all();
        $conditions = Condition::all();

        return view('user.host.projects.edit', compact('project', 'projectTypes', 'conditions'));
    }

    /**
     * Actualizar proyecto PROPIO
     */
    public function update(Request $request, $id)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $id)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('projects', 'title')->ignore($project->id)
            ],
            'description' => 'required|string|min:50|max:2000',
            'project_type_id' => 'required|exists:project_types,id',
            'location' => 'required|string|min:3|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'work_hours_per_day' => 'required|in:2 Horas,4 Horas,6 Horas,8 Horas',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'conditions' => 'nullable|array',
            'conditions.*' => 'exists:conditions,id'
        ]);

        $validated['enabled'] = $request->has('enabled');

        //manejo de la imagen
        if ($request->hasFile('image')) {
            if ($project->image == 'logo-horizontal.svg') {
                $this->imageService->storeImage($request->file('image'), 'projects');
            } else {
                $validated['image'] = $this->imageService->updateImage(
                    $request->file('image'), //pasando nueva img
                    $project->image, //img anterior a borrar
                    'projects' //directorio nueva img
                );
            }
        }

        $project->update($validated);

        // Sincronizar condiciones
        if ($request->has('conditions')) {
            $project->conditions()->sync($request->conditions);
        } else {
            $project->conditions()->detach();
        }

        return redirect()
            ->route('anfitriones.my-projects.index')
            ->with('success', 'Proyecto actualizado exitosamente');
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
        if ($project->image && $project->image !== 'logo-horizontal.svg') {
            $this->imageService->deleteImage($project->image);
        }

        $project->delete();

        return redirect()
            ->route('anfitriones.my-projects.index')
            ->with('success', 'Proyecto eliminado exitosamente');
    }


    public function acceptVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $project->volunteers()->updateExistingPivot($volunteerId, [
            'status' => 'aceptado',
            'accepted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Voluntario aceptado exitosamente.');
    }

    public function rejectVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->first();

        if (!$project) {
            abort(403, 'Acceso denegado o proyecto inexistente.');
        }

        $project->volunteers()->updateExistingPivot($volunteerId, [
            'status' => 'rechazado',
        ]);

        return redirect()->back()->with('success', 'Voluntario rechazado exitosamente.');
    }
}

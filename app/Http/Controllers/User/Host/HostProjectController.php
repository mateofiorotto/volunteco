<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectType;
use App\Models\Condition;
use App\Services\ImageService;

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

        return view('user.host.projects-list', compact('projects'));
    }

    /**
     * Mostrar formulario de creación de proyecto
     */
    public function create()
    {
        $projectTypes = ProjectType::all();
        $conditions = Condition::all();

        return view('user.host.create-project', compact('projectTypes', 'conditions'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'conditions' => 'nullable|array',
            'conditions.*' => 'exists:conditions,id'
        ]);

        //asignar el host_id del anfitrión autenticado
        $validated['host_id'] = $host->id;
        $validated['enabled'] = $request->has('enabled');

        //manejo de la imagen
        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->storeImage($request->file('image'), 'projects');
        }

        $validated['image'] = $imagePath;

        $project = Project::create($validated);

        // Asociar condiciones si las hay
        if ($request->has('conditions')) {
            $project->conditions()->attach($request->conditions);
        }

        return redirect()
            ->route('my-projects.index')
            ->with('success', 'Proyecto creado exitosamente');
    }

    // /**
    //  * Mostrar formulario de edición de proyecto
    //  */
    // public function edit(Project $project)
    // {
    //     $host = Auth::user()->host;

    //     // Verificar que el proyecto pertenece al anfitrión autenticado
    //     if (!$host || $project->host_id !== $host->id) {
    //         abort(403, 'No tienes permiso para editar este proyecto');
    //     }

    //     $projectTypes = ProjectType::all();
    //     $conditions = Condition::all();

    //     return view('host.projects.edit', compact('project', 'projectTypes', 'conditions'));
    // }

    // /**
    //  * Actualizar proyecto
    //  */
    // public function update(Request $request, Project $project)
    // {
    //     $host = Auth::user()->host;

    //     // Verificar que el proyecto pertenece al anfitrión autenticado
    //     if (!$host || $project->host_id !== $host->id) {
    //         abort(403, 'No tienes permiso para actualizar este proyecto');
    //     }

    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'project_type_id' => 'required|exists:project_types,id',
    //         'location' => 'required|string|max:255',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after:start_date',
    //         'work_hours_per_day' => 'required|integer|min:1|max:24',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'conditions' => 'nullable|array',
    //         'conditions.*' => 'exists:conditions,id',
    //         'enabled' => 'boolean',
    //     ]);

    //     $validated['enabled'] = $request->has('enabled') ? true : false;

    //     // Manejo de la imagen
    //     if ($request->hasFile('image')) {
    //         // Eliminar la imagen anterior si existe
    //         if ($project->image) {
    //             Storage::disk('public')->delete($project->image);
    //         }
    //         $validated['image'] = $request->file('image')->store('projects', 'public');
    //     }

    //     $project->update($validated);

    //     // Sincronizar condiciones
    //     if ($request->has('conditions')) {
    //         $project->conditions()->sync($request->conditions);
    //     } else {
    //         $project->conditions()->detach();
    //     }

    //     return redirect()
    //         ->route('my-projects.index')
    //         ->with('success', 'Proyecto actualizado exitosamente');
    // }

    // /**
    //  * Eliminar proyecto
    //  */
    // public function destroy(Project $project)
    // {
    //     $host = Auth::user()->host;

    //     // Verificar que el proyecto pertenece al anfitrión autenticado
    //     if (!$host || $project->host_id !== $host->id) {
    //         abort(403, 'No tienes permiso para eliminar este proyecto');
    //     }

    //     // Eliminar imagen asociada si existe
    //     if ($project->image) {
    //         Storage::disk('public')->delete($project->image);
    //     }

    //     // Desasociar condiciones
    //     $project->conditions()->detach();

    //     // Desasociar voluntarios
    //     $project->volunteers()->detach();

    //     $project->delete();

    //     return redirect()
    //         ->route('my-projects.index')
    //         ->with('success', 'Proyecto eliminado exitosamente');
    // }

    // /**
    //  * Mostrar voluntarios inscritos en los proyectos del anfitrión
    //  */
    // public function registeredHosts()
    // {
    //     $host = Auth::user()->host;

    //     if (!$host) {
    //         return redirect()->back()->with('error', 'No tienes un perfil de anfitrión');
    //     }

    //     $projects = $host->projects()
    //         ->with(['volunteers' => function ($query) {
    //             $query->with('user')
    //                 ->wherePivotIn('status', ['pending', 'accepted', 'rejected'])
    //                 ->orderByPivot('applied_at', 'desc');
    //         }])
    //         ->get();

    //     return view('host.projects.registered-volunteers', compact('projects'));
    // }

    // /**
    //  * Aceptar un voluntario inscrito
    //  */
    // public function acceptHost(Request $request, Volunteer $host)
    // {
    //     $hostAuth = Auth::user()->host;

    //     if (!$hostAuth) {
    //         return back()->with('error', 'No tienes un perfil de anfitrión');
    //     }

    //     $request->validate([
    //         'project_id' => 'required|exists:projects,id'
    //     ]);

    //     $projectId = $request->input('project_id');
    //     $project = Project::findOrFail($projectId);

    //     // Verificar que el proyecto pertenece al anfitrión autenticado
    //     if ($project->host_id !== $hostAuth->id) {
    //         abort(403, 'No tienes permiso para gestionar este proyecto');
    //     }

    //     // Verificar que el voluntario está inscrito en el proyecto
    //     if (!$project->volunteers()->where('volunteer_id', $host->id)->exists()) {
    //         return back()->with('error', 'El voluntario no está inscrito en este proyecto');
    //     }

    //     // Actualizar el estado del voluntario
    //     $project->volunteers()->updateExistingPivot($host->id, [
    //         'status' => 'accepted',
    //         'accepted_at' => now()
    //     ]);

    //     // Opcional: Enviar notificación al voluntario
    //     // $host->user->notify(new VolunteerAccepted($project));

    //     return back()->with('success', 'Voluntario aceptado exitosamente');
    // }

    // /**
    //  * Rechazar un voluntario inscrito
    //  */
    // public function rejectHost(Request $request, Volunteer $host)
    // {
    //     $hostAuth = Auth::user()->host;

    //     if (!$hostAuth) {
    //         return back()->with('error', 'No tienes un perfil de anfitrión');
    //     }

    //     $request->validate([
    //         'project_id' => 'required|exists:projects,id'
    //     ]);

    //     $projectId = $request->input('project_id');
    //     $project = Project::findOrFail($projectId);

    //     // Verificar que el proyecto pertenece al anfitrión autenticado
    //     if ($project->host_id !== $hostAuth->id) {
    //         abort(403, 'No tienes permiso para gestionar este proyecto');
    //     }

    //     // Verificar que el voluntario está inscrito en el proyecto
    //     if (!$project->volunteers()->where('volunteer_id', $host->id)->exists()) {
    //         return back()->with('error', 'El voluntario no está inscrito en este proyecto');
    //     }

    //     // Actualizar el estado del voluntario
    //     $project->volunteers()->updateExistingPivot($host->id, [
    //         'status' => 'rejected'
    //     ]);

    //     // Opcional: Enviar notificación al voluntario
    //     // $host->user->notify(new VolunteerRejected($project));

    //     return back()->with('success', 'Voluntario rechazado');
    // }
}

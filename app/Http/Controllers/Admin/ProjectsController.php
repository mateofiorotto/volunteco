<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectDeletedMail;

class ProjectsController extends Controller
{
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * mostrar lista de proyectos
     */
    public function index()
    {
        $projects = Project::with('host')
        ->paginate(6);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * mostrar detalles de un proyecto
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * eliminar un proyecto y enviar mail notificando la eliminación
     */
    public function deleteProject($id)
    {
        $project = Project::with('host.user')->findOrFail($id);

        //eliminar img si existe
        if ($project->image) {
            $this->imageService->deleteImage($project->image);
        }

        //desvincular a los voluntarios del proyecto
        if ($project->volunteers()->exists()) {
            $project->volunteers()->detach();
        }

        //guardar info para enviar mail
        $hostEmail = $project->host->user->email;
        $hostName = $project->host->name;
        $projectTitle = $project->title;

        //eliminar
        $project->delete();

        //mail
        Mail::to($hostEmail)->send(new ProjectDeletedMail($hostName, $projectTitle));

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto eliminado correctamente y notificación enviada por email al anfitrión.');
    }
}

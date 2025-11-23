<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectDeletedMail;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{

    /**
     * mostrar lista de proyectos
     */
    public function index()
    {
        $projects = Project::with('host')
        ->latest()
        ->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * mostrar detalles de un proyecto
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }


    public function disabled($id) {
        $project = Project::with('host.user')->findOrFail($id);

        $project->enabled = false;
        $project->save();

        //guardar info para enviar mail
        $hostEmail = $project->host->user->email;
        $hostName = $project->host->name;
        $projectTitle = $project->title;

        Mail::to($hostEmail)->send(new ProjectDeletedMail($hostName, $projectTitle));

        return redirect()->route('admin.projects.index')->with('success', 'El proyecto se desactivo correctamente y se notificó al anfitrión.');

    }

    /**
     * eliminar un proyecto y enviar mail notificando la eliminación
     */
    public function delete($id)
    {
        $project = Project::with('host.user')->findOrFail($id);

        //eliminar img si existe
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        //guardar info para enviar mail
        $hostEmail = $project->host->user->email;
        $hostName = $project->host->name;
        $projectTitle = $project->title;

        //mail
        Mail::to($hostEmail)->send(new ProjectDeletedMail($hostName, $projectTitle));

        //eliminar
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto eliminado correctamente y notificación enviada por email al anfitrión.');
    }
}

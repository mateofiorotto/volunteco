<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Volunteer;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Province;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use App\Models\VolunteerEvaluation;

class FrontendController extends Controller
{
    /**
     * Devuelve la vista de inicio con 3 proyectos recientes
     *
     */
    public function home()
    {
        $projects = Project::public()
            ->with('location.province')
            ->take(3)
            ->latest()
            ->get();

        return view('frontend.home', compact('projects'));
    }

    /**
     * Devuelve el listado de proyectos con paginación
     */
    public function projects(Request $request)
    {
        $search = $request->search;
        $provinceId = $request->province_id;
        $projectTypeId = $request->project_type_id;

        $projects = Project::query()
            ->public()
            ->with(['location.province', 'projectType'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($provinceId, function ($q) use ($provinceId) {
                $q->whereHas('location', function ($l) use ($provinceId) {
                    $l->where('province_id', $provinceId);
                });
            })
            ->when($projectTypeId, function ($q) use ($projectTypeId) {
                $q->where('project_type_id', $projectTypeId);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Listado de provincias sincronizadas con los filtros activos
        $provinces = Province::whereHas('locations.projects', function ($q) use ($search, $projectTypeId) {
            $q->public();

            if ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            }

            if ($projectTypeId) {
                $q->where('project_type_id', $projectTypeId);
            }
        })->orderBy('name')->get();

        // Listado de proyectos con contador sincronizado
        $projectTypes = ProjectType::withCount([
            'projects as projects_count' => function ($q) use ($search, $provinceId) {
                $q->public();

                if ($search) {
                    $q->where(function ($qq) use ($search) {
                        $qq->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                    });
                }

                if ($provinceId) {
                    $q->whereHas('location', function ($l) use ($provinceId) {
                        $l->where('province_id', $provinceId);
                    });
                }
            }
        ])->having('projects_count', '>', 0)->orderBy('name')->get();

        return view('frontend.projects', compact('projects', 'provinces', 'projectTypes'));
    }


    /**
     * Devuelve la vista de detalles de un proyecto por su id
     *
     * @param int $id
     */
    public function projectById($id)
    {

        $project = Project::with([
            'host',
            'location.province'
        ])->public()->findOrFail($id);

        //obtener el voluntario asociado al usuario autenticado
        $volunteer = Auth::user()?->volunteer;

        $isAceptedByHost = null;
        $isInHostRoster = null;

        $volunteerStatus = null;
        $evaluation = null;

        if ($volunteer) {
            // Obtenermos el voluntario en este proyecto
            $pivotRecord = $project->volunteers()
                ->where('volunteer_id', $volunteer->id)
                ->first();

            // Obtenemos el estado del voluntario en este proyecto
            $volunteerStatus = $pivotRecord ? $pivotRecord->pivot->status : null;

            $isAceptedByHost = $volunteer->isHostAcepted($project->host->id);

            $isInHostRoster = $volunteer->isInHostRoster($project->host->id);

            $evaluation = VolunteerEvaluation::where('project_id', $project->id)
                ->where('volunteer_id', $volunteer->id)
                ->first();

        }

        return view('frontend.project-details', compact('project', 'volunteerStatus', 'isAceptedByHost','isInHostRoster', 'volunteer', 'evaluation'));
    }

    /**
     * Devuelve la vista "sobre nosotros"
     *
     */
    public function about()
    {
        return view('frontend.about');
    }


    /**
     * Devuelve la vista de contacto
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
 * Procesa el formulario de contacto
 */
public function sendContact(Request $request)
{
    $validated = $request->validate([
        'name'    => ['required', 'string', 'min:2', 'max:100'],
        'email'   => ['required', 'email', 'max:150'],
        'subject' => ['required', 'string', 'min:3', 'max:150'],
        'message' => ['required', 'string', 'min:10', 'max:2000'],
    ], [
        'name.required'    => 'El nombre es obligatorio.',
        'name.min'         => 'El nombre debe tener al menos 2 caracteres.',
        'name.max'         => 'El nombre no puede superar los 100 caracteres.',
        'email.required'   => 'El correo electrónico es obligatorio.',
        'email.email'      => 'Ingresá un correo electrónico válido.',
        'email.max'        => 'El correo no puede superar los 150 caracteres.',
        'subject.required' => 'El asunto es obligatorio.',
        'subject.min'      => 'El asunto debe tener al menos 3 caracteres.',
        'subject.max'      => 'El asunto no puede superar los 150 caracteres.',
        'message.required' => 'El mensaje es obligatorio.',
        'message.min'      => 'El mensaje debe tener al menos 10 caracteres.',
        'message.max'      => 'El mensaje no puede superar los 2000 caracteres.',
    ]);

    Mail::to("volunteco@gmail.com")->send(new ContactMessageMail($validated));

    return redirect()->route('contact')->with('success', 'Tu mensaje fue enviado correctamente. ¡Nos pondremos en contacto a la brevedad!');
}

    /**
     * Devuelve la vista de cómo funciona
     */
    public function howItWorks()
    {
        return view('frontend.how-it-works');
    }

    /**
     * Devuelve la vista de donar
     */
    public function donate()
    {
        return view('frontend.donate');
    }

}

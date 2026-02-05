<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Volunteer;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Province;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontendController extends Controller
{
    public function home()
    {
        $projects = Project::where('enabled', true)
            ->with('location.province')
            ->take(3)
            ->latest()
            ->get();

        return view('frontend.home', compact('projects'));
    }

    /**
     * Devolver listado de proyectos con paginación
     */
    public function projects(Request $request)
    {
        $search = $request->search;
        $provinceId = $request->province_id;
        $projectTypeId = $request->project_type_id;

        // Listado de proyectos
        $projectsQuery = Project::where('enabled', true)
            ->with(['location.province', 'projectType']);

        // buscador por palabra clave
        if ($search) {
            $projectsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // por provincia
        if ($provinceId) {
            $projectsQuery->whereHas('location', function ($q) use ($provinceId) {
                $q->where('province_id', $provinceId);
            });
        }

        // por tipo de proyecto
        if ($projectTypeId) {
            $projectsQuery->where('project_type_id', $projectTypeId);
        }

        $projects = $projectsQuery
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Listado de provincias sincronizadas con los filtros activos
        $provinces = Province::whereHas('locations.projects', function ($q) use ($search, $projectTypeId) {
            $q->where('enabled', true);

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
                $q->where('enabled', true);

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


    public function projectById($id)
    {
        $project = Project::where('id', $id)->where('enabled', true)->with('volunteers')->firstOrFail();

        //obtener el voluntario asociado al usuario autenticado
        $volunteer = Volunteer::where('user_id', Auth::id())->first();

        $volunteerStatus = null;

        $isAceptedByHost = null;

        if ($volunteer) {
            // Obtenemos el estado del voluntario en este proyecto
            $pivotRecord = $project->volunteers()
                ->where('volunteer_id', $volunteer->id)
                ->first();

            if ($pivotRecord) {
                $volunteerStatus = $pivotRecord->pivot->status;
            }

            $isAceptedByHost = $volunteer->isHostAcepted($project->host->id);
        }

        return view('frontend.project-details', compact('project', 'volunteerStatus', 'isAceptedByHost'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function howItWorks()
    {
        return view('frontend.how-it-works');
    }

    public function donate()
    {
        return view('frontend.donate');
    }

    public function shop()
    {
        $products = Product::where('stock', '>', 0)
            ->latest()
            ->paginate(6);
        return view('frontend.shop', compact('products'));
    }

    public function product($id)
    {
        $product = Product::where('id', $id)
            ->where('stock', '>', 0)
            ->firstOrFail();

        //productos relacionados (aleatorios, excluyendo el actual)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }


}

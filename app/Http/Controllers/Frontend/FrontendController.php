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
    /**
     * Devuelve la vista de inicio con 3 proyectos recientes
     *
     */
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
     * Devuelve el listado de proyectos con paginación
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


    /**
     * Devuelve la vista de detalles de un proyecto por su id
     * 
     * @param int $id
     */
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

    /**
     * Devuelve la vista de la tienda con productos en stock y paginación
     */
    public function shop()
    {
        $products = Product::where('stock', '>', 0)
            ->latest()
            ->paginate(6);
        return view('frontend.shop', compact('products'));
    }

    /**
     * Devuelve la vista de un producto por su id y productos relacionados aleatorios
     * * @param int $id
     */
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

    public function cart()
    {
        $products = Product::where('stock', '>', 0)
            ->latest()
            ->paginate(6);
        return view('frontend.cart', compact('products'));

    }


}

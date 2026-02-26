<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\VolunteerAccepted;
use App\Models\VolunteerEvaluation;
use App\Models\ProjectVolunteer;

class HostProjectVolunteerController extends Controller
{
    // Aceptar voluntario en un proyecto
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
            'status' => ProjectVolunteer::STATUS_ACCEPTED,
            'accepted_at' => now(),
            'rejected_at' => null,
        ]);

        Mail::to($volunteer->user->email)->send(
            new VolunteerAccepted($volunteer->full_name, $project->title)
        );

        return redirect()->back()->with('success', 'Voluntario aceptado exitosamente.');
    }

    // Rechazar un voluntario de un proyecto
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
            'status' => ProjectVolunteer::STATUS_REJECTED,
            'rejected_at' => now(),
        ]);

        return redirect()->back()->with('success', 'El voluntario ha sido rechazado.');
    }

    // Cancela un voluntario aceptado de un proyecto
    public function cancelVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->firstOrFail();

        $volunteer = $project->volunteers()
            ->withPivot('status')
            ->where('volunteers.id', $volunteerId)
            ->firstOrFail();

        // Cancelar solo si estaba aceptado
        if (!$volunteer->pivot->isAccepted()) {
            return redirect()->back()
                ->with('error', 'Solo puedes cancelar voluntarios aceptados.');
        }

        $project->volunteers()->updateExistingPivot($volunteerId, [
            'status' => ProjectVolunteer::STATUS_CANCELED,
            'canceled_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'El voluntario fue cancelado correctamente.');
    }

    public function completeVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->firstOrFail();

        $volunteer = $project->volunteers()
            ->withPivot('status')
            ->where('volunteers.id', $volunteerId)
            ->firstOrFail();

        // Solo puede completar si está aceptado
        if (!$volunteer->pivot->isAccepted()) {
            return redirect()->back()
                ->with('error', 'Solo puedes marcar como completado a voluntarios aceptados.');
        }

        $project->volunteers()->updateExistingPivot($volunteerId, [
            'status' => ProjectVolunteer::STATUS_COMPLETED,
            'completed_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'El voluntario fue marcado como completado.');
    }

    // Resumen de la evaluación
    public function evaluatedVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->firstOrFail();

        $volunteer = $project->volunteers()
            ->with('user')
            ->where('volunteers.id', $volunteerId)
            ->firstOrFail();

        $evaluation = $project->evaluations()
            ->where('volunteer_id', $volunteerId)
            ->first();

        if (!$evaluation) {
            return redirect()->route('host.my-projects.evaluation-volunteer', [$projectId, $volunteerId]);
        }

        $levels = [
            1 => 'Bajo',
            2 => 'Aceptable',
            3 => 'Bueno',
            4 => 'Muy bueno',
            5 => 'Excelente',
        ];

        return view('user.host.projects.volunteer-evaluation', compact('volunteer', 'project', 'levels', 'evaluation'));
    }

    // Formulario para evaluar al voluntario
    public function evaluationVolunteer($projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->firstOrFail();

        $volunteer = $project->volunteers()
            ->with('user')
            ->withPivot('status')
            ->where('volunteers.id', $volunteerId)
            ->firstOrFail();

        if (!$volunteer->pivot->isFinished()) {
            return redirect()
                ->route('host.my-projects.show', $projectId)
                ->with('error', 'Solo puedes evaluar voluntarios que ya no esten activos.');
        }

        $evaluation = $project->evaluations()
            ->where('volunteer_id', $volunteerId)
            ->first();

        if ($evaluation) {
            return redirect()->route('host.my-projects.evaluated-volunteer', [$projectId, $volunteerId]);
        }

        $levels = [
            1 => 'Bajo',
            2 => 'Aceptable',
            3 => 'Bueno',
            4 => 'Muy bueno',
            5 => 'Excelente',
        ];

        return view('user.host.projects.volunteer', compact('volunteer', 'project', 'levels'));

    }

    // Evalución del host al voluntario en el proyecto
    public function evaluateVolunteer(Request $request, $projectId, $volunteerId)
    {
        $host = Auth::user()->host;

        $project = Project::where('id', $projectId)
            ->where('host_id', $host->id)
            ->firstOrFail();

        if (Auth::user()->host->id !== $project->host_id) {
            abort(403);
        }

        $volunteer = $project->volunteers()
            ->withPivot('status')
            ->where('volunteers.id', $volunteerId)
            ->firstOrFail();

        if (!$volunteer->pivot->isFinished()) {
            return redirect()
                ->route('host.my-projects.show', $projectId)
                ->with('error', 'Solo puedes evaluar voluntarios que ya no esten activos.');
        }

        if ($project->hasEvaluationForVolunteer($volunteerId)) {
            return redirect()->route('host.my-projects.evaluated-volunteer', [$projectId, $volunteerId])->with('error', 'Este voluntario ya fue evaluado.');
        }

        $request->validate([
            'attitude_score' => 'required|integer|min:1|max:5',
            'skills_score' => 'required|integer|min:1|max:5',
            'responsibility_score' => 'required|integer|min:1|max:5',
            'strengths' => 'required|string|min:8|max:250',
            'improvements' => 'nullable|string|min:8|max:250',
        ], [
            'attitude_score.required' => 'Debes marcar un valor en actitud y motivación.',
            'skills_score.required' => 'Debes marcar un valor en habilidades técnicas.',
            'responsibility_score.required' => 'Debes marcar un valor en responsabilidad y compromiso.',
            'strengths.required' => 'Por favor, comparte una fortaleza destacada como reconocimiento a su desempeño.',
            'strengths.max' => 'Sé breve. El comentario no debe superar los :max caracteres.',
            'strengths.min' => 'Describe brevemente una fortaleza (mínimo :min caracteres).',
            'improvements.min' => 'El comentario debe tener como mínimo :min caracteres.',
        ]);

        VolunteerEvaluation::create([
            'project_id' => $projectId,
            'volunteer_id' => $volunteerId,
            'host_id' => Auth::user()->host->id,
            'attitude_score' => $request->attitude_score,
            'skills_score' => $request->skills_score,
            'responsibility_score' => $request->responsibility_score,
            'strengths' => $request->strengths,
            'improvements' => $request->improvements,
        ]);

        return redirect()->route('host.my-projects.show', $projectId)->with('success', 'Evaluación guardada correctamente');
    }

}

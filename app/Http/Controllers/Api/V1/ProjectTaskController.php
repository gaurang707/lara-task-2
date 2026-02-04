<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectTaskResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class ProjectTaskController extends Controller
{
    use AuthorizesRequests;
    public function index(Project $project) {      

        return response()->json([
            'data' => ProjectTaskResource::collection($project->tasks()->latest()->get())
        ]);   
    }
}

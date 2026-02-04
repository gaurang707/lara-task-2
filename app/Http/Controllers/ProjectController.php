<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize("viewAny", Project::class);
        return view("projects.index");
    }

    public function getdata(Request $request)
    {
        $this->authorize("viewAny", Project::class);
        $data = Project::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn("deadline", function ($row) {
                return $row->deadline->format('d M Y');
            })
            ->editColumn("created_at", function ($row) {
                return $row->created_at->format('d M Y');
            })
            ->addColumn('action', function ($row) {
                return view('projects.action', compact('row'))->render();

            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {

        $this->authorize("create", Project::class);
        return view("projects.create");
    }

    public function store(StoreProjectRequest $request)
    {
        $this->authorize("create", Project::class);
        Project::create($request->validated());
        ToastMagic::success('Project created successfully!');
        return response()->redirectToRoute('projects.index', 200);
    }

    public function show(Project $project)
    {
        $this->authorize("view", $project);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize("update", $project);
        return view('projects.edit', compact('project'));
    }


    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize("update", $project);
        Project::findOrFail($project->id)->update($request->validated());
        ToastMagic::success('Project Updated Successfully');
        return response()->redirectToRoute('projects.index', 200);
    }


    public function destroy(Project $project)
    {
        $this->authorize("delete", $project);
        Project::findOrFail($project->id)->delete();
        ToastMagic::success('PRoject Deleted Successfully');
        return response()->redirectToRoute('projects.index', 200);
    }
}

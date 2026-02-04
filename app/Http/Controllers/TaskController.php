<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use function Termwind\render;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {   
        $this->authorize('viewAny', Task::class);        
        return view("tasks.index");
    }

    public function getdata(Request $request)
    {
        $this->authorize('viewAny', Task::class);
        $user = auth()->user();        
        if($user->role()=="admin") {
            $collection = Task::with('project:id,name', 'assignee:id,name,email')->select('tasks.*')->limit(2)->get();
            $collection = Task::with('project:id,name', 'assignee')->select('tasks.*');
        } else {
            $collection = Task::with('project:id,name', 'assignee:id,name,email')->select('tasks.*')
                ->where('assigned_id', $user->id);
        }       

        return Datatables::of($collection)
            ->addIndexColumn()
            ->addColumn('project_name', function ($row) {
                return $row->project->name ? $row->project->name : '';
            })
            ->addColumn('assignee_name', function ($row) {
                return $row->assignee->name ? $row->assignee->name : '';
            })
            ->addColumn('assignee_email', function ($row) {
                return $row->assignee->email ? $row->assignee->email : '';
            })
            ->filterColumn('project_name', function ($query, $keyword) {
                $query->whereHas('project', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('assignee_name', function ($query, $keyword) {
                $query->whereHas('assignee', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('assignee_email', function ($query, $keyword) {
                $query->whereHas('assignee', function ($q) use ($keyword) {
                    $q->where('email', 'like', "%{$keyword}%");
                });
            })
            // Enable Ordering
            ->orderColumn('project_name', function ($query, $order) {
                $query->orderBy(Project::select('name')->whereColumn('projects.id', 'tasks.project_id'), $order);
            })
            ->orderColumn('assignee_name', function ($query, $order) {
                $query->orderBy(User::select('name')->whereColumn('users.id', 'tasks.assigned_id'), $order);
            })
            ->orderColumn('assignee_email', function ($query, $order) {
                $query->orderBy(User::select('email')->whereColumn('users.id', 'tasks.assigned_id'), $order);
            })
            ->editColumn("created_at", function ($row) {
                return $row->created_at->format('d M Y');
            })
            ->addColumn('action', function ($row) {
                return view('tasks.action', compact('row'))->render();

            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        return view("tasks.create", [
            'projects' => Project::orderBy('id', 'asc')->get(),
            'users' => User::orderBy('id', 'asc')->get(),
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);
        Task::create($request->validated());
        ToastMagic::success('Task created successfully!');
        return response()->redirectToRoute('tasks.index');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', [
            'projects' => Project::orderBy('id', 'asc')->get(),
            'users' => User::orderBy('id', 'asc')->get(),
            'task' => $task
        ]);
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        Task::findOrFail($task->id)->update($request->validated());
        ToastMagic::success('Task Updated Successfully');
        return response()->redirectToRoute('tasks.index', 200);
    }


    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        Task::findOrFail($task->id)->delete();
        ToastMagic::success('Task Deleted Successfully');
        return response()->redirectToRoute('tasks.index', 200);
    }
}

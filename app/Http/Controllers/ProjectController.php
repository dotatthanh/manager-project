<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use App\Models\Customer;
use App\Models\Room;
use App\Models\TechStack;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::paginate(10);

        if ($request->search) {
            $projects = Project::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $projects->appends(['search' => $request->search]);
        }

        $data = [
            'projects' => $projects
        ];

        return view('project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::where('status', 1)->get();
        $rooms = Room::all();
        $users = User::all();
        $customers = Customer::where('status', 1)->get();
        $tech_stacks = TechStack::where('status', 1)->get();

        $data = [
            'users' => $users,
            'types' => $types,
            'rooms' => $rooms,
            'customers' => $customers,
            'tech_stacks' => $tech_stacks,
        ];

        return view('project.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $project = Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
                'type_id' => $request->type_id,
                'room_id' => $request->room_id,
                'customer_id' => $request->customer_id,
                'tech_stack_id' => $request->tech_stack_id,
                'start_date' => date("Y-m-d", strtotime($request->start_date)),
                'end_date' => date("Y-m-d", strtotime($request->end_date)),
            ]);

            $project->users()->attach($request->users);
            
            DB::commit();
            return redirect()->route('projects.index')->with('alert-success','Thêm dự án thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm dự án thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::where('status', 1)->get();
        $rooms = Room::all();
        $users = User::all();
        $customers = Customer::where('status', 1)->get();
        $tech_stacks = TechStack::where('status', 1)->get();

        $data = [
            'users' => $users,
            'types' => $types,
            'rooms' => $rooms,
            'customers' => $customers,
            'tech_stacks' => $tech_stacks,
            'data_edit' => $project,
        ];

        return view('project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            DB::beginTransaction();

            $project->update([
                'name' => $request->name,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
                'type_id' => $request->type_id,
                'room_id' => $request->room_id,
                'customer_id' => $request->customer_id,
                'tech_stack_id' => $request->tech_stack_id,
                'start_date' => date("Y-m-d", strtotime($request->start_date)),
                'end_date' => date("Y-m-d", strtotime($request->end_date)),
                'progress' => $request->progress,
            ]);

            $project->users()->sync($request->users);
            
            DB::commit();
            return redirect()->route('projects.index')->with('alert-success','Sửa dự án thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa dự án thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try {
            DB::beginTransaction();

            $project->destroy($project->id);
            $project->users()->detach();
            
            DB::commit();
            return redirect()->route('projects.index')->with('alert-success','Xóa dự án thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa dự án thất bại!');
        }
    }
}

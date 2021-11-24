<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use App\Models\Customer;
use App\Models\Room;
use App\Models\TechStack;

class StatisticProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Room::all();
        $users = User::all();
        $customers = Customer::where('status', 1)->get();
        $tech_stacks = TechStack::where('status', 1)->get();
        $types = Type::where('status', 1)->get();


        $projects = Project::query();



        if ($request->name) {
            $projects = $projects->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->type_id) {
            $projects = $projects->where('type_id', $request->type_id);
        }

        if ($request->customer_id) {
            $projects = $projects->where('customer_id', $request->customer_id);
        }

        if ($request->room_id) {
            $projects = $projects->where('room_id', $request->room_id);
        }

        if ($request->start_date) {
            $start_date = date("Y-m-d", strtotime($request->start_date));
            $projects = $projects->whereDate('start_date', '>=' ,$start_date);
        }

        if ($request->end_date) {
            $end_date = date("Y-m-d", strtotime($request->end_date));
            $projects = $projects->whereDate('end_date', '<=', $end_date);
        }

        if ($request->status) {
            $projects = $projects->where('status', $request->status);
        }

        if ($request->tech_stacks) {
            $request_tech_stacks = $request->tech_stacks;
            $projects = $projects->whereHas('techStacks', function($query) use ($request_tech_stacks)
            {
                $query->whereIn('id', $request_tech_stacks);
            });
        }

        if ($request->users) {
            $request_users = $request->users;
            $projects = $projects->whereHas('users', function($query) use ($request_users)
            {
                $query->whereIn('id', $request_users);
            });
        }

        $projects = $projects->paginate(10);
        $projects->appends([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'customer_id' => $request->customer_id,
            'room_id' => $request->room_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'tech_stacks' => $request->tech_stacks,
            'users' => $request->users,
        ]);

        $data = [
            'projects' => $projects,
            'types' => $types,
            'customers' => $customers,
            'tech_stacks' => $tech_stacks,
            'users' => $users,
            'rooms' => $rooms,
        ];

        return view('statistic.project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

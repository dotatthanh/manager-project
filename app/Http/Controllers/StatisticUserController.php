<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\TechStack;
use App\Models\User;

class StatisticUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Room::all();
        $tech_stacks = TechStack::where('status', 1)->get();

        $users = User::query();

        if ($request->room_id) {
            $users = $users->where('room_id', $request->room_id);
        }
        
        if ($request->tech_stacks) {
            $request_tech_stacks = $request->tech_stacks;
            $users = $users->whereHas('techStacks', function($query) use ($request_tech_stacks)
            {
                $query->whereIn('id', $request_tech_stacks);
            });
        }
        
        if (isset($request->status)) {
            if ($request->status == 1) {
                $users = $users->has('projects');
            }
            if ($request->status == 0) {
                $users = $users->doesntHave('projects');
            }
        }

        $users = $users->paginate(10);
        $users->appends([
            'status' => $request->status,
            'room_id' => $request->room_id,
            'tech_stacks' => $request->tech_stacks,
        ]);

        $data = [
            'users' => $users,
            'tech_stacks' => $tech_stacks,
            'rooms' => $rooms,
        ];

        return view('statistic.user.index', $data);
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

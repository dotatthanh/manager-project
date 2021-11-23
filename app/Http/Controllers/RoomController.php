<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Room::paginate(10);

        if ($request->search) {
            $rooms = Room::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $rooms->appends(['search' => $request->search]);
        }

        $data = [
            'rooms' => $rooms
        ];

        return view('room.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Room::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            
            DB::commit();
            return redirect()->route('rooms.index')->with('alert-success','Thêm phòng ban thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm phòng ban thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $data = [
            'data_edit' => $room
        ];

        return view('room.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoomRequest $request, Room $room)
    {
        try {
            DB::beginTransaction();

            $room->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            
            DB::commit();
            return redirect()->route('rooms.index')->with('alert-success','Sửa phòng ban thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa phòng ban thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        try {
            DB::beginTransaction();

            if ($room->users->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa phòng ban thất bại! Phòng ban '.$room->name.' đang có nhân sự.');
            }

            if ($room->projects->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa phòng ban thất bại! Phòng ban '.$room->name.' đang có dự án.');
            }

            $room->destroy($room->id);
            
            DB::commit();
            return redirect()->route('rooms.index')->with('alert-success','Xóa phòng ban thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa phòng ban thất bại!');
        }
    }
}

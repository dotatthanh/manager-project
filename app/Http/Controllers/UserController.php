<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TechStack;
use App\Models\Room;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);

        if ($request->search) {
            $users = User::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $users->appends(['search' => $request->search]);
        }

        $data = [
            'users' => $users
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $tech_stacks = TechStack::where('status', 1)->get();
        $rooms = Room::all();
        
        $data = [
            'roles' => $roles,
            'tech_stacks' => $tech_stacks,
            'rooms' => $rooms
        ];

        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $file_path = '';
            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/user/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/user', $request->avatar, $name);
            }
            
            $create = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'name' => $request->name,
                'tech_stack_id' => $request->tech_stack_id,
                'room_id' => $request->room_id,
                'birthday' => date("Y-m-d", strtotime($request->birthday)),
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'avatar' => $file_path,
                'gender' => $request->gender,
                'card_id' => $request->card_id,
                'foreign_language' => $request->foreign_language,
                'experience' => $request->experience,
            ]);

            foreach ($request->roles as $role_id) {
                $role = Role::find($role_id)->name;
                $create->assignRole($role);
            }

            $create->update([
                'code' => 'TK'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Thêm nhân sự thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm nhân sự thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $tech_stacks = TechStack::where('status', 1)->get();
        $rooms = Room::all();

        $data = [
            'data_edit' => $user,
            'roles' => $roles,
            'rooms' => $rooms,
            'tech_stacks' => $tech_stacks
        ];

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/user/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/user', $request->avatar, $name);
                
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'birthday' => date("Y-m-d", strtotime($request->birthday)),
                    'tech_stack_id' => $request->tech_stack_id,
                    'room_id' => $request->room_id,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'avatar' => $file_path,
                    'card_id' => $request->card_id,
                    'foreign_language' => $request->foreign_language,
                    'experience' => $request->experience,
                ]);
            }
            else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'birthday' => date("Y-m-d", strtotime($request->birthday)),
                    'tech_stack_id' => $request->tech_stack_id,
                    'room_id' => $request->room_id,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'card_id' => $request->card_id,
                    'foreign_language' => $request->foreign_language,
                    'experience' => $request->experience,
                ]);
            }
        
            $user->roles()->detach();

            foreach ($request->roles as $role_id) {
                $role = Role::find($role_id)->name;
                $user->assignRole($role);
            }
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Sửa nhân sự thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa nhân sự thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            if ($user->projects->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa nhân sự thất bại! Nhân sự '.$user->name.' đang có dự án.');
            }

            $user->roles()->detach();
            $user->destroy($user->id);
            
            DB::commit();
            return redirect()->route('users.index')->with('alert-success','Xóa nhân sự thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa nhân sự thất bại!');
        }
    }
}

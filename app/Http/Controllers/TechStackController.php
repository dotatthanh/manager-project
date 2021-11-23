<?php

namespace App\Http\Controllers;

use App\Models\TechStack;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTechStackRequest;
use DB;

class TechStackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tech_stacks = TechStack::paginate(10);

        if ($request->search) {
            $tech_stacks = TechStack::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $tech_stacks->appends(['search' => $request->search]);
        }

        $data = [
            'tech_stacks' => $tech_stacks
        ];

        return view('tech-stack.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tech-stack.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechStackRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = TechStack::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            
            DB::commit();
            return redirect()->route('tech_stacks.index')->with('alert-success','Thêm công nghệ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm công nghệ thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TechStack  $techStack
     * @return \Illuminate\Http\Response
     */
    public function show(TechStack $techStack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TechStack  $techStack
     * @return \Illuminate\Http\Response
     */
    public function edit(TechStack $techStack)
    {
        $data = [
            'data_edit' => $techStack
        ];

        return view('tech-stack.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TechStack  $techStack
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTechStackRequest $request, TechStack $techStack)
    {
        try {
            DB::beginTransaction();

            $techStack->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            
            DB::commit();
            return redirect()->route('tech_stacks.index')->with('alert-success','Sửa công nghệ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa công nghệ thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TechStack  $techStack
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechStack $techStack)
    {
        try {
            DB::beginTransaction();

            if ($techStack->projects->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa công nghệ thất bại! Công nghệ '.$techStack->name.' đang có dự án.');
            }

            if ($techStack->users->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa công nghệ thất bại! Công nghệ '.$techStack->name.' đang có nhân sự.');
            }

            $techStack->destroy($techStack->id);
            
            DB::commit();
            return redirect()->route('tech_stacks.index')->with('alert-success','Xóa công nghệ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa công nghệ thất bại!');
        }
    }
}

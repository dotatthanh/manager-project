<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::paginate(10);

        if ($request->search) {
            $customers = Customer::where('name', 'like', '%'.$request->search.'%')->paginate(10);
            $customers->appends(['search' => $request->search]);
        }

        $data = [
            'customers' => $customers
        ];

        return view('customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Customer::create([
                'name' => $request->name,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
            ]);
            
            DB::commit();
            return redirect()->route('customers.index')->with('alert-success','Thêm loại dự án thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm loại dự án thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data = [
            'data_edit' => $customer
        ];

        return view('customer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        try {
            DB::beginTransaction();

            $customer->update([
                'name' => $request->name,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
            ]);
            
            DB::commit();
            return redirect()->route('customers.index')->with('alert-success','Sửa loại dự án thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa loại dự án thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            DB::beginTransaction();

            if ($customer->projects->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa loại dự án thất bại! Loại dự án '.$customer->name.' đang có dự án.');
            }

            $customer->destroy($customer->id);
            
            DB::commit();
            return redirect()->route('customers.index')->with('alert-success','Xóa loại dự án thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa loại dự án thất bại!');
        }
    }
}

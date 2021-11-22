<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->position == 'marketing' || auth()->user()->position == 'superadmin') {            
            return view('orders.create', [
                'jobTypes' => JobType::all(),
            ]);            
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->position == 'marketing' || auth()->user()->position == 'superadmin') {

            $rules = [
                'cust_code' => ['required', 'max:3'],
                'quantity' => ['required', 'min:1', 'integer'],
                'job_type_code' => ['required'],
                'po_number' => ['required', 'min:2', 'max:255'],
                'due_date' => ['required', 'date', 'after_or_equal:'.today()],
                'description' => ['required', 'min:2', 'max:255'],
            ];
    
            $validatedData = $request->validate($rules);
    
            $validatedData['cust_code'] = strtoupper($validatedData['cust_code']);
    
            if (isset($request->no_drawing)) {
                $validatedData['no_drawing'] = $request->no_drawing;
                $validatedData['no_drawing'] = strtoupper($validatedData['no_drawing']);
            }
    
            if(isset($request->tool_code)) {
                $validatedData['tool_code'] = $request->tool_code;
                $validatedData['tool_code'] = strtoupper($validatedData['tool_code']);
            }
            
            if(isset($request->note)) {
                $validatedData['note'] = $request->note;
            }
    
            // membuat nomor shop order 21 11 09 002
            // kode tanggal
            $code = date('ymd');
    
            // ambil nomor SO terakhir
            $lastSO = Order::latest()->first();
            $lastSO = $lastSO->shop_order;
    
            // buat nomor SO
            if(substr($lastSO, 0, 6) == $code) {
                $validatedData['shop_order'] = $lastSO + 1;
            } else {
                $validatedData['shop_order'] = $code . '001';
            }
    
            Order::create($validatedData);
    
            return redirect()->back()->with('success', 'Pekerjaan berhasil diregistrasi');
            
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.detail', [
            'order' => $order,
            'jobTypes' => JobType::all(),
            'processes' => $order->tool->flowProcess->sortBy('op_number'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $rules = [
            // 'shop_order' => ['required'],
            'quantity' => ['required'],
            'job_type_code' => ['required'],
            'po_number' => ['required'],
            'due_date' => ['required'],
            'description' => ['required'],
        ];

        $validatedData = $request->validate($rules);

        $validatedData['tool_code'] = $request['tool_code'];
        $validatedData['note'] = $request['note'];
        $validatedData['no_drawing'] = $request['no_drawing'];

        $validatedData['updated_by'] = auth()->user()->username;

        Order::where('shop_order', $order->shop_order)->update($validatedData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

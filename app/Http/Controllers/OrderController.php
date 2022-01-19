<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Models\JobType;
use App\Models\Order;
use App\Models\Tool;
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

    public function store(Request $request) {
        // jika cust_code dan tool_code ada di database
        // dan jika user tidak mengisi nomor drawing
        // 1. ambil nomor gambarnya
        // 2. update flow processnya

        // jika user mengisi nomor drawing
        // 1. isi otomatis kode toolnya
        // 2. update flow processnya

        // jika user mengisi kode tool beserta nomor gambar
        // jika datanya match meskipun drawing sudah tidak digunakan
        // 1. jangan ubah input user
        // 2. update flow processnya

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
                    
            if(isset($request->tool_code)) {
                $validatedData['tool_code'] = strtoupper($request->tool_code);
                $noDrawingFromDB = Tool::getDrawingNumber(
                                        $validatedData['tool_code'], 
                                        $validatedData['cust_code']);                
                (isset($noDrawingFromDB)) ? $noDrawingFromDB = $noDrawingFromDB->drawing : false;

                $validatedData['no_drawing'] = (isset($request->no_drawing)) ? strtoupper($request->no_drawing) : $noDrawingFromDB;

            } elseif (isset($request->no_drawing)) {
                $toolCodeFromDB = Tool::getByDrawing($request->no_drawing);
                (isset($toolCodeFromDB)) ? $toolCodeFromDB = $toolCodeFromDB->code : false;
                $validatedData['tool_code'] = $toolCodeFromDB;
                $validatedData['no_drawing'] = strtoupper($request->no_drawing);
            }
            
            if(isset($request->note)) {
                $validatedData['note'] = $request->note;
            }
    
            // membuat nomor shop order 21 11 09 002
            // kode tanggal
            $code = date('ymd');
    
            // ambil nomor SO terakhir
            $lastSO = Order::latest()->first()->shop_order;
    
            // buat nomor SO
            $validatedData['shop_order'] = (substr($lastSO, 0, 6) == $code) ? ++$lastSO : $code . '001';            
    
            Order::create($validatedData);

            if (isset($validatedData['no_drawing']) && isset($validatedData['tool_code'])) {
                FlowProcess::copyToOrder($validatedData['shop_order'], $validatedData['no_drawing']);
            }

            return back()->with('success', 'Pekerjaan berhasil diregistrasi');
            
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
        if (isset($order->tool->flowProcess)) {
            $masterFlowProcess = unserialize($order->tool->flowProcess->process);
        } else {
            $masterFlowProcess = null;
        }

        return view('orders.detail', [
            'order' => $order,
            'jobTypes' => JobType::all(),
            'masterFlowProcess' => $masterFlowProcess,
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

    public function update(Request $request, Order $order)
    {
        $rules = [
            'quantity' => ['required'],
            'job_type_code' => ['required'],
            'po_number' => ['required'],
            'due_date' => ['required'],
            'description' => ['required'],
        ];

        $validatedData = $request->validate($rules);
        $validatedData['tool_code'] = strtoupper($request['tool_code']);
        $validatedData['note'] = $request['note'];
        $validatedData['no_drawing'] = strtoupper($request['no_drawing']);
        $validatedData['updated_by'] = auth()->user()->username;

        // membuat flow process local secara otomatis
        if ($validatedData['no_drawing']) {
            FlowProcess::copyToOrder($order->shop_order, $validatedData['no_drawing']);
        }

        Order::getByShopOrder($order->shop_order)->update($validatedData);
        return back()->with('success', 'Data berhasil diperbarui');
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

    public function printLabel($shop_order) {
        $order = Order::getByShopOrder($shop_order);
        $flow_process = unserialize($order->flow_process);
        $labels = [];

        if (count($flow_process) > 1) {
            foreach ($flow_process as $key => $proces) {
                array_push($labels, "$shop_order-$key");
            }
        } else {
            $labels[] = $shop_order;
        }

        return view('orders.print-label', [
            'labels' => $labels, 
            'cust_code' => $order->cust_code,
            'due_date' => date('d-M-Y', strtotime($order->due_date))
        ]);
    }
}

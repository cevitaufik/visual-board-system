<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Models\JobType;
use App\Models\Order;
use App\Models\Tool;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $flowProcess;
    private $order;
    private $jobTypes;
    private $tool;

    function __construct() {
        $this->flowProcess = new FlowProcess;
        $this->order = new Order;
        $this->jobTypes = JobType::all();
        $this->tool = new Tool;
    }

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
                'jobTypes' => $this->jobTypes,
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
                $noDrawingFromDB = $this->tool->getDrawingNumber(
                                        $validatedData['tool_code'], 
                                        $validatedData['cust_code']);                
                (isset($noDrawingFromDB)) ? $noDrawingFromDB = $noDrawingFromDB->drawing : false;
                $validatedData['no_drawing'] = ($request->no_drawing) ?? $noDrawingFromDB;
                (isset($validatedData['no_drawing'])) ? $validatedData['no_drawing'] = strtoupper($validatedData['no_drawing']) : false;
            } elseif (isset($request->no_drawing)) {
                $toolCodeFromDB = $this->tool->getByDrawing($request->no_drawing);
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
            $lastSO = $this->order->latest()->first()->shop_order;
    
            // buat nomor SO
            $validatedData['shop_order'] = (substr($lastSO, 0, 6) == $code) ? ++$lastSO : $code . '001';            
    
            $this->order->create($validatedData);

            if ($validatedData['no_drawing'] && $validatedData['tool_code']) {
                $this->flowProcess->copyToOrder($validatedData['shop_order'], $validatedData['no_drawing']);
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
            'jobTypes' => $this->jobTypes,
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
            $this->flowProcess->copyToOrder($order->shop_order, $validatedData['no_drawing']);
        }

        $this->order->getByShopOrder($order->shop_order)->update($validatedData);
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
}

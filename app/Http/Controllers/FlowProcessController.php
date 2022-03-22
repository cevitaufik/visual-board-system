<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Models\Order;
use App\Models\Tool;
use App\Models\WorkCenter;
use Illuminate\Http\Request;


class FlowProcessController extends Controller
{

    public function index() {
        return view('flow-processes.index', [
            'processes' => FlowProcess::with(['tool'])->get()->sortBy('no_drawing'),
        ]);
    }


    public function create() {
        return view('flow-processes.create', [
            'workCenters' => WorkCenter::all(),
        ]);
    }


    public function store(Request $request) {
        $flow = $request->flow;
        unset($flow['no_drawing']);

        $no_drawing = strtoupper($request->flow['no_drawing']);
        $cust_code = substr($no_drawing, 0, 3);
        $code = substr($no_drawing, 0, 10);

        Tool::firstOrCreate(['drawing' => $no_drawing], [
            'cust_code' => $cust_code,
            'description' => '--PERLU PENGECEKAN ENGINEERING. data ditambahkan otomatis--',
            'note' => '--PERLU PENGECEKAN ENGINEERING. data ditambahkan otomatis--',
            'code' => $code,
            'status' => 'TIDAK DIGUNAKAN',
        ]);

        $data = [
            'no_drawing' => $no_drawing,
            'process' => serialize($flow),
        ];

        // dd($data);
        // $this->flowProcess->firstOrCreate(
        //     ['no_drawing' => $no_drawing],
        //     ['process' => "123"]
        // );

        FlowProcess::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    public function show(FlowProcess $flowProcess)
    {
        $flow = FlowProcess::whereNo_drawing($flowProcess->no_drawing)->first();
        $processes = unserialize($flow->process);

        return view('flow-processes.detail', [
            'flow' => $flow,
            'processes' => $processes,
            'workCenters' => WorkCenter::all(),
        ]);
    }

    
    // public function edit(FlowProcess $flowProcess)
    // {
    //     //
    // }
    
    public function update(Request $request, FlowProcess $flowProcess)
    {
        $flow = $request->flow;
        unset($flow['no_drawing']);

        FlowProcess::whereId($flowProcess->id)->update([
            'no_drawing' => strtoupper($request->flow['no_drawing']),
            'process' => serialize($flow)
        ]);

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    
    public function destroy(FlowProcess $flowProcess) {
        FlowProcess::destroy($flowProcess->id);
        return redirect('/flow-process')->with('success', 'Data berhasil dihapus');
    }

    public function table() {
        return view('flow-processes.table', [
            'processes' => FlowProcess::all()->sortBy('no_drawing'),
        ]);
    }

    public function createNew($no_drawing) {
        return view('flow-processes.create', [
            'no_drawing' => $no_drawing,
            'workCenters' => WorkCenter::all(),
        ]);
    }


    public function makeMaster($shop_order) {
        $data = Order::getByShopOrder($shop_order);
        $flow_process = unserialize($data->flow_process);

        foreach ($flow_process as $pk => $flowProcesses) {
            foreach ($flowProcesses as $ck => $process) {
                unset($flow_process[$pk][$ck]['start']);
                unset($flow_process[$pk][$ck]['end']);
                unset($flow_process[$pk][$ck]['qty']);
                unset($flow_process[$pk][$ck]['status']);
                unset($flow_process[$pk][$ck]['processed_by']);
            }
        }

        FlowProcess::create([
            'no_drawing' => $data->no_drawing,
            'process' => serialize($flow_process),
        ]);

        Tool::firstOrCreate(
            ['drawing' => $data->no_drawing],
            [
                'cust_code' => $data->cust_code,
                'code' => ($data->tool_code) ?? substr($data->no_drawing, 0, 10),
                'description' => '--PERLU PENGECEKAN ENGINEERING. data ditambahkan otomatis--',
                'note' => '--PERLU PENGECEKAN ENGINEERING. data ditambahkan otomatis--',
                'status' => 'TIDAK DIGUNAKAN',                
            ]
        );
        
        return back()->with('success', 'Flow proses master telah di buat.');
    }

    public function copyFlowProcessFromMaster($shop_order) {
        $no_drawing = Order::getByShopOrder($shop_order)->no_drawing;
        FlowProcess::copyToOrder($shop_order, $no_drawing);
        return redirect()->back()->with('success', 'Flow proses telah diperbarui.');
    }

    public function print($shop_order) {
        return view('flow-processes.print-wo', ['order' => Order::getByShopOrder($shop_order)]);
    }


    public function deleteFlowProcess($shop_order) {
        Order::getByShopOrder($shop_order)->update(['flow_process' => null]);
        return back()->with('success', 'Flow proses berhasil di hapus.');
    }


    public function bulkPrintWO(Request $request) {

        $shopOrders = rtrim($request->shop_orders, ',');
        $shopOrders = explode(',', $shopOrders);

        $orders = Order::all();
        $flow_process = [];

        foreach ($shopOrders as $so) {
            array_push($flow_process, $orders->where('shop_order', $so)->first());
        }

        return view('flow-processes.print', ['orders' => $flow_process]);
    }    
}

// $data = [
//     1 => [
//         10 => ['SG', 'POTONG', 10],
//         20 => ['BRZ', 'BRAZING', 5],
//     ],
//     2 => [
//         10 => ['SG', 'POTONG', 10],
//         20 => ['BRZ', 'BRAZING', 5],
//     ],
// ];
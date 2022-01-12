<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Models\Order;
use App\Models\Tool;
use App\Models\WorkCenter;
use Illuminate\Http\Request;

class FlowProcessController extends Controller
{
    function getOrder($shop_order) {
        return Order::whereShop_order($shop_order)->first();
    }


    public function index()
    {
        return view('flow-processes.index', [
            'processes' => FlowProcess::with(['tool'])->get()->sortBy('no_drawing'),
        ]);
    }


    public function create()
    {
        return view('flow-processes.create', [
            'workCenters' => WorkCenter::all(),
        ]);
    }


    public function store(Request $request)
    {
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

        FlowProcess::create([
            'no_drawing' => $no_drawing,
            'process' => serialize($flow),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    public function show(FlowProcess $flowProcess)
    {
        // $flows = FlowProcess::where('no_drawing', $flowProcess->no_drawing)->get()->sortBy('op_number');
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

    
    public function destroy(FlowProcess $flowProcess)
    {
        FlowProcess::destroy($flowProcess->id);
        return redirect('/flow-process')->with('success', 'Data berhasil dihapus');
    }

    public function table()
    {
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


    public function makeMaster($cust_code, $tool_code, $no_drawing) {
        $processes = unserialize(Order::whereNo_drawing($no_drawing)->first()->flow_process);
        foreach ($processes as $key => $process) {
            $flow['no_drawing'] = $no_drawing;
            $flow['op_number'] = $key;
            $flow['work_center'] = $process['work_center'];
            $flow['description'] = $process['description'];
            $flow['estimation'] = $process['estimation'];

            FlowProcess::create($flow);
        }

        Tool::firstOrCreate(
            ['drawing' => $no_drawing],
            [
                'cust_code' => $cust_code,
                'code' => $tool_code,
            ]
        );
        
        return back()->with('success', 'Flow proses master telah di buat.');
    }


    public function copy($shop_order, $no_drawing) {
        $datas = FlowProcess::where('no_drawing', $no_drawing)->get()->sortBy('op_number');
        $fp = [];
        
        foreach ($datas as $data) {
            $fp[$data->op_number] = [
                'work_center' => "$data->work_center", 
                'description' => "$data->description", 
                'estimation' => "$data->estimation",
                'start' => null,
                'end' => null,
                'qty' => null,
                'status' => 'open',
                'processed_by' => null,
            ];
        }

        Order::where('shop_order', $shop_order)->update(['flow_process' => serialize($fp)]);
        
        return redirect()->back()->with('success', 'Flow proses telah diperbarui.');
    }

    public function print($shop_order) {
        $order = $this->getOrder($shop_order);
        return view('flow-processes.print', ['order' => $order]);
    }


    public function deleteFlowProcess($shop_order) {
        Order::whereShop_order($shop_order)->update(['flow_process' => null]);
        return back()->with('success', 'Flow proses berhasil di hapus.');
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
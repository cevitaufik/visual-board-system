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
            'processes' => FlowProcess::all()->sortBy('no_drawing'),
            // 'processes' => DB::table('flow_processes')
            //                     ->orderBy('op_number', 'asc')
            //                     ->get()
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
        foreach ($request->flow as $flow) {
            $flow['no_drawing'] = strtoupper($flow['no_drawing']);
            FlowProcess::create($flow);
        }

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    public function show(FlowProcess $flowProcess)
    {
        $flows = FlowProcess::where('no_drawing', $flowProcess->no_drawing)->get()->sortBy('op_number');

        return view('flow-processes.detail', [
            'flows' => $flows,
            'workCenters' => WorkCenter::all(),
        ]);
    }

    
    // public function edit(FlowProcess $flowProcess)
    // {
    //     //
    // }
    
    public function update(Request $request, FlowProcess $flowProcess)
    {
        if (isset($request['deleted'])) {
            foreach ($request['deleted'] as $del) {
                FlowProcess::where('id', $del)->delete();
            }
        }        

        if (isset($request['flow'])) {
            foreach ($request->flow as $flow) {
                if ($flow['id'] == 'new') {
                    unset($flow['id']);
                    FlowProcess::create($flow);
                } else {
                    FlowProcess::where('id', $flow['id'])->update($flow);
                }
            }
        }

        if (count(FlowProcess::where('no_drawing', $request->drawing)->get())) {
            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect('/flow-process')->with('success', 'Data berhasil dihapus');
        }
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

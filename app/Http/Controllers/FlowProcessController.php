<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Models\Order;
use App\Models\WorkCenter;
use Illuminate\Http\Request;

class FlowProcessController extends Controller
{
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
        $order = Order::whereShop_order($shop_order)->first();

        return view('flow-processes.print', ['order' => $order]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use App\Models\Order;
use App\Models\Tool;
use App\Models\WorkCenter;
use Illuminate\Http\Request;

class FlowProcessController extends Controller
{
    private $flowProcess;
    private $order;
    private $workCenter;
    private $tool;

    function __construct() {
        $this->flowProcess = new FlowProcess;
        $this->order = new Order;
        $this->workCenter = WorkCenter::all();
        $this->tool = new Tool;
    }

    public function index() {
        return view('flow-processes.index', [
            'processes' => $this->flowProcess->with(['tool'])->get()->sortBy('no_drawing'),
        ]);
    }


    public function create() {
        return view('flow-processes.create', [
            'workCenters' => $this->workCenter,
        ]);
    }


    public function store(Request $request) {
        $flow = $request->flow;
        unset($flow['no_drawing']);

        $no_drawing = strtoupper($request->flow['no_drawing']);
        $cust_code = substr($no_drawing, 0, 3);
        $code = substr($no_drawing, 0, 10);

        $this->tool->firstOrCreate(['drawing' => $no_drawing], [
            'cust_code' => $cust_code,
            'description' => '--PERLU PENGECEKAN ENGINEERING. data ditambahkan otomatis--',
            'note' => '--PERLU PENGECEKAN ENGINEERING. data ditambahkan otomatis--',
            'code' => $code,
            'status' => 'TIDAK DIGUNAKAN',
        ]);

        $this->flowProcess->create([
            'no_drawing' => $no_drawing,
            'process' => serialize($flow),
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    public function show(FlowProcess $flowProcess)
    {
        $flow = $this->flowProcess->whereNo_drawing($flowProcess->no_drawing)->first();
        $processes = unserialize($flow->process);

        return view('flow-processes.detail', [
            'flow' => $flow,
            'processes' => $processes,
            'workCenters' => $this->workCenter,
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

        $this->flowProcess->whereId($flowProcess->id)->update([
            'no_drawing' => strtoupper($request->flow['no_drawing']),
            'process' => serialize($flow)
        ]);

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    
    public function destroy(FlowProcess $flowProcess) {
        $this->flowProcess->destroy($flowProcess->id);
        return redirect('/flow-process')->with('success', 'Data berhasil dihapus');
    }

    public function table() {
        return view('flow-processes.table', [
            'processes' => $this->flowProcess->all()->sortBy('no_drawing'),
        ]);
    }

    public function createNew($no_drawing) {
        return view('flow-processes.create', [
            'no_drawing' => $no_drawing,
            'workCenters' => $this->workCenter,
        ]);
    }


    public function makeMaster($shop_order) {
        $data = $this->order->getByShopOrder($shop_order);
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

        $this->flowProcess->create([
            'no_drawing' => $data->no_drawing,
            'process' => serialize($flow_process),
        ]);

        $this->tool->firstOrCreate(
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
        $no_drawing = $this->order->getByShopOrder($shop_order)->no_drawing;
        $this->flowProcess->copyToOrder($shop_order, $no_drawing);
        return redirect()->back()->with('success', 'Flow proses telah diperbarui.');
    }

    public function print($shop_order) {
        return view('flow-processes.print', ['order' => $this->order->getByShopOrder($shop_order)]);
    }


    public function deleteFlowProcess($shop_order) {
        $this->order->getByShopOrder($shop_order)->update(['flow_process' => null]);
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
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Production;
use App\Models\WorkCenter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productions.index', [
            'title' => 'Job card'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    private function additionalProcess($shop_order, $subprocess, $op_number): array {
        $flow_process = unserialize(Order::getByShopOrder($shop_order)->flow_process);

        $arrayKeys = array_keys($flow_process[$subprocess]);
        $arrayKeysFiltered = [];

        foreach ($arrayKeys as $key) {
            if (str_contains($key, $op_number)) {
                array_push($arrayKeysFiltered, $key);
            }
        }

        $lastOP = end($arrayKeysFiltered);

        if (str_contains($lastOP, '-')) {
            $index = stripos($lastOP, '-');
            $lastOP = substr($lastOP, ++$index);
            $lastOP = $op_number . '-' . ++$lastOP;
        } else {
            $lastOP = "$lastOP-1";
        }
        
        $flow_process[$subprocess][$lastOP] = null;
        ksort($flow_process[$subprocess]);

        return ['new_key' => $lastOP, 'flow_process' => $flow_process];
    }
    
    public function store(Request $request)
    {
        $shop_order = substr($request->shop_order, 0, 9);
        $inputSubprocess = substr($request->shop_order, 10);
        $subprocess = ($inputSubprocess != '') ? $inputSubprocess : "0";
        $orderData = Order::getByShopOrder($shop_order);

        $op_number = ($request->after_op_number) ?? $request->op_number;

        if (isset($request->after_op_number)) {
            $data = $this->additionalProcess($shop_order, $subprocess, $op_number);
            $flow_process = $data['flow_process'];
            $op_number = $data['new_key'];

            $flow_process[$subprocess][$op_number]['op_number'] = $op_number;
            $flow_process[$subprocess][$op_number]['work_center'] = $request->work_center;
            $flow_process[$subprocess][$op_number]['description'] = $request->description;
            $flow_process[$subprocess][$op_number]['estimation'] = 0;
            $flow_process[$subprocess][$op_number]['end'] = null;
        } else {
            $flow_process = unserialize($orderData->flow_process);
        }

        $flow_process[$subprocess][$op_number]['note'] = $request->note;
        $flow_process[$subprocess][$op_number]['processed_by'] = $request->processed_by;
        $flow_process[$subprocess][$op_number]['qty'] = $request->qty;        

        $work_center = $flow_process[$subprocess][$op_number]['work_center'];
        $estimation = $flow_process[$subprocess][$op_number]['estimation'];
        $description = $flow_process[$subprocess][$op_number]['description'];

        if($request->end) {
            $flow_process[$subprocess][$op_number]['end'] = Carbon::now()->timestamp;
            $flow_process[$subprocess][$op_number]['status'] = 'done';
        } elseif ($request->start) {
            $flow_process[$subprocess][$op_number]['start'] = Carbon::now()->timestamp;
            $flow_process[$subprocess][$op_number]['status'] = 'on process';
        }

        $flow_process = serialize($flow_process);
        Order::getByShopOrder($shop_order)->update(['flow_process' => $flow_process]);

        $operation = [
            'no_shop_order' => $shop_order,
            'subprocess' => $subprocess,
            'work_center' => $work_center,
            'estimation' => $estimation,
            'description' => $description,
            'processed_by' => $request->processed_by,
            'quantity' =>  $request->qty,
            'note' => $request->note,
        ];

        // menyimpan data ke tabel productions
        if ($request->start) {
            $operation['start'] = date("Y-m-d H:i:s");
        }

        if ($request->end) {
            $operation['end'] = date("Y-m-d H:i:s");
        }

        if ($request->after_op_number) {
            $operation['op'] = $op_number;
        } else {
            $operation['op'] = $request->op_number;
        }

        Production::create($operation);

        return redirect('/productions');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Production $production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        //
    }

    // 220116004-7

    public function processForm($shop_order) {
        $inputSubprocess = substr($shop_order, 10);
        $shopOrder = substr($shop_order, 0, 9);
        $dataOrder = Order::getByShopOrder($shopOrder);
        $subprocess = ($inputSubprocess != '') ? $inputSubprocess : "0";

        if ($dataOrder) {
            if (count(unserialize($dataOrder->flow_process)) >= $subprocess) {
                $flow_process = unserialize($dataOrder->flow_process)[$subprocess];
                foreach ($flow_process as $index => $process) {
                    if ($process['status'] == 'open' || $process['status'] == 'on process') {
                        $currentProcess = $flow_process[$index];
                        break;
                    }
                }

                if (isset($currentProcess)) {
                    return view('productions.jobcard', [
                        'title' => 'Jobcard - ' . $shopOrder,
                        'currentProcess' => $currentProcess,
                        'processes' => $flow_process,
                        'shop_order' => $shop_order,
                        'qty' => $dataOrder->quantity,
                        'subprocess' => $subprocess,
                        'work_center' => WorkCenter::all(),
                    ]);
                } else {
                    $currentProcess = $flow_process[array_key_last($flow_process)];
                    return view('productions.jobcard', [
                        'title' => 'Jobcard',
                        'finishMsg' => 'Proses sudah selesai',
                        'currentProcess' => $currentProcess,
                        'processes' => $flow_process,
                        'shop_order' => $shop_order,
                        'qty' => $dataOrder->quantity,
                        'subprocess' => $subprocess,
                        'work_center' => WorkCenter::all(),
                    ]);
                }
        
                
            } else { 
                
                return view('productions.jobcard', [
                    'title' => 'Jobcard',
                    'errorMsg' => 'Nomor SO tidak ditemukan',
                ]);
    
            }
        } else { 
                
            return view('productions.jobcard', [
                'title' => 'Jobcard',
                'errorMsg' => 'Nomor SO tidak ditemukan',
            ]);

        }
        
    }

    // private function additonalProcessChecker($shop_order, $op) {
    //     $op_number = Production::whereNo_shop_order($shop_order)->whereOp($op)->latest()->first();
    //     return $op_number->op;
    // }

    
}

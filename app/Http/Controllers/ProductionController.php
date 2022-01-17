<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Production;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    private $production;
    private $order;
    private $carbon;

    function __construct() {
        $this->production = new Production;
        $this->order = new Order;
        $this->carbon = new Carbon;
    }


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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop_order = substr($request->shop_order, 0, 9);
        $inputSubprocess = substr($request->shop_order, 10);
        $subprocess = ($inputSubprocess != '') ? $inputSubprocess : "0";

        $orderData = $this->order->getByShopOrder($shop_order);
        $flow_process = unserialize($orderData->flow_process);
        $flow_process[$subprocess][$request->op_number]['note'] = $request->note;
        $flow_process[$subprocess][$request->op_number]['processed_by'] = $request->processed_by;
        $flow_process[$subprocess][$request->op_number]['note'] = $request->note;

        $work_center = $flow_process[$subprocess][$request->op_number]['work_center'];
        $estimation = $flow_process[$subprocess][$request->op_number]['estimation'];
        $description = $flow_process[$subprocess][$request->op_number]['description'];

        if($request->end) {
            $flow_process[$subprocess][$request->op_number]['end'] = $this->carbon->timestamp;
            $flow_process[$subprocess][$request->op_number]['status'] = 'done';
        } elseif ($request->start) {
            $flow_process[$subprocess][$request->op_number]['start'] = $this->carbon->timestamp;
            $flow_process[$subprocess][$request->op_number]['status'] = 'on process';
        }        

        $flow_process[$subprocess][$request->op_number]['qty'] = $request->qty;
        $flow_process = serialize($flow_process);

        $this->order->getByShopOrder($shop_order)->update(['flow_process' => $flow_process]);

        $operation = [
            'no_shop_order' => $shop_order,
            'subprocess' => $subprocess,
            'op' => $request->op_number,
            // 'additional' => null,
            'work_center' => $work_center,
            'estimation' => $estimation,
            'description' => $description,
            'processed_by' => $request->processed_by,
            'quantity' =>  $request->qty,
        ];

        if ($request->start) {
            $operation['start'] = date("Y-m-d H:i:s");
        }

        if ($request->end) {
            $operation['finish'] = date("Y-m-d H:i:s");
        }

        if ($request->note) {
            $operation['note'] = $request->note;
        }

        $this->production->create($operation);

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
        $dataOrder = $this->order->getByShopOrder($shopOrder);
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
                    ]);
                } else {
                    return view('productions.jobcard', [
                        'title' => 'Jobcard',
                        'errorMsg' => 'Proses sudah selesai',
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
}

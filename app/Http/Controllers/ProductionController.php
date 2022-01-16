<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Production;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    private $production;
    private $order;

    function __construct() {
        $this->production = new Production;
        $this->order = new Order;
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
        //
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
        $subprocess = ($inputSubprocess != '') ? $inputSubprocess : "1";

        if (count(unserialize($dataOrder->flow_process)) >= $subprocess) {
            $flow_process = unserialize($dataOrder->flow_process)[$subprocess];
            foreach ($flow_process as $index => $process) {
                if ($process['status'] == 'open') {
                    $currentProcess = $flow_process[$index];
                    break;
                }
            }
    
            return view('productions.jobcard', [
                'title' => 'Jobcard - ' . $shopOrder,
                'currentProcess' => $currentProcess,
                'processes' => $flow_process,
                'shop_order' => $shop_order,
                'qty' => $dataOrder->quantity,
            ]);
        } else { 
            
            return view('productions.jobcard', [
                'title' => 'Jobcard',
                'errorMsg' => 'Nomor SO tidak ditemukan',
            ]);

        }
        
    }
}

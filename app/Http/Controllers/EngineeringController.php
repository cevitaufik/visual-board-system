<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\JobType;
use App\Models\Engineering;
use Illuminate\Http\Request;

class EngineeringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->position == 'engineering' || auth()->user()->position == 'superadmin') {

            return view('dashboard', [
                'orders' => Order::where('current_process', '=', 'eng')
                                ->orWhere('current_process', '=', null)
                                ->latest()
                                ->get(),
                'jobTypes' => JobType::all(['code']),
            ]);
            
        } else {
            abort(403);
        }
    }

    public function table() {
        return view('layouts.dashboard-table', [
            'orders' => Order::where('current_process', '=', 'eng')
            ->orWhere('current_process', '=', null)
            ->latest()
            ->get(),
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
     * @param  \App\Models\Engineering  $engineering
     * @return \Illuminate\Http\Response
     */
    public function show(Engineering $engineering)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Engineering  $engineering
     * @return \Illuminate\Http\Response
     */
    public function edit(Engineering $engineering)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Engineering  $engineering
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engineering $engineering)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Engineering  $engineering
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engineering $engineering)
    {
        //
    }
}

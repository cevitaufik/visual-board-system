<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FlowProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('flow-processes.index', [
            'processes' => FlowProcess::all()->sortBy('op_number'),
            // 'processes' => DB::table('flow_processes')
            //                     ->orderBy('op_number', 'asc')
            //                     ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flow-processes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'no_drawing' => ['required', 'max:13'],
            'op_number' => ['required'],
            'work_center' => ['required'],
            'estimation' => ['required'],
        ];

        if(isset($request['description'])) {
            $rules['description'] = ['max:500'];
        }

        $validatedData = $request->validate($rules);
        
        FlowProcess::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function show(FlowProcess $flowProcess)
    {
        return view('flow-processes.detail', [
            'process' => $flowProcess
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowProcess $flowProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowProcess $flowProcess)
    {
        $rules = [
            'op_number' => ['required', 
                                // 'unique:flow_processes,op_number,' . $request->op_number
                                // Rule::unique('flow_processes')
                                // ->where(function ($query) use($no_drawing, $op_number) {
                                //     return $query->where('no_drawing', $no_drawing)
                                //             ->where('op_number', $op_number);
                                // })
                            ],
            'no_drawing' => ['required', 'max:13'],
            'work_center' => ['required'],
            'estimation' => ['required'],
        ];

        if(isset($request['description'])) {
            $rules['description'] = ['max:500'];
        }

        $validatedData = $request->validate($rules);
        
        FlowProcess::where('id', $flowProcess->id)->update($validatedData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlowProcess  $flowProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowProcess $flowProcess)
    {
        FlowProcess::destroy($flowProcess->id);
        return redirect('/flow-process')->with('success', 'Data berhasil dihapus');
    }

    public function table() {
        return view('flow-processes.table', [
            'processes' => FlowProcess::all()->sortBy('op_number'),
        ]);
    }
}

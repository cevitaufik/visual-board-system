<?php

namespace App\Http\Controllers;

use App\Models\FlowProcess;
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

        // ddd($request);
        // $rules = [
        //     'no_drawing' => ['required', 'max:13'],
        //     'op_number' => ['required'],
        //     'work_center' => ['required'],
        //     'estimation' => ['required'],
        // ];

        // if(isset($request['description'])) {
        //     $rules['description'] = ['max:500'];
        // }

        // $validatedData = $request->validate($rules);

        // FlowProcess::create($validatedData);

        // ddd($request->flow);

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
        // $rules = [
        //     'op_number' => ['required', 
        //                         // 'unique:flow_processes,op_number,' . $request->op_number
        //                         // Rule::unique('flow_processes')
        //                         // ->where(function ($query) use($no_drawing, $op_number) {
        //                         //     return $query->where('no_drawing', $no_drawing)
        //                         //             ->where('op_number', $op_number);
        //                         // })
        //                     ],
        //     'no_drawing' => ['required', 'max:13'],
        //     'work_center' => ['required'],
        //     'estimation' => ['required'],
        // ];

        // if(isset($request['description'])) {
        //     $rules['description'] = ['max:500'];
        // }

        // $validatedData = $request->validate($rules);

        // FlowProcess::where('id', $flowProcess->id)->update($validatedData);

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
}

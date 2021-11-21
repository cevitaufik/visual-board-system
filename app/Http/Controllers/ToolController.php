<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tools.index', [
            'tools' => Tool::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tools.create');
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
            'cust_code' => ['required', 'max:3'],
            'drawing' => ['required', 'max:13', 'unique:tools'],
            'description' => ['required', 'max:255'],
        ];

        $request['cust_code'] = strtoupper($request['cust_code']);

        if(isset($request['note'])) {
            $rules['note'] = ['max:500'];
        }

        if($request['code'] != null) {
            $rules['code'] = ['max:255'];
            $request['code'] = strtoupper($request['code']);
        }

        $validatedData = $request->validate($rules);

        if($request->file('dwg_customer')) {
            $fileName = $request['drawing'] . '_customer' . '.' . $request->file('dwg_customer')->extension();
            $validatedData['dwg_customer'] = $request->file('dwg_customer')->storeAs('dwg_customer', $fileName);
        }

        if($request->file('dwg_production')) {
            $fileName = $request['drawing'] . '_produksi' . '.' . $request->file('dwg_production')->extension();
            $validatedData['dwg_production'] = $request->file('dwg_production')->storeAs('dwg_production', $fileName);
        }
        
        if($request['code'] == null) {
            $code = substr($request->drawing, 0, 10);
            $validatedData['code'] = $code;
        }

        Tool::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        return view('tools.detail', [
            'tool' => $tool,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $rules = [
            'drawing' => ['required', 'max:13'],
            'code' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
        ];

        if(isset($request['note'])) {
            $rules['note'] = ['max:500'];
        }

        $validatedData = $request->validate($rules);

        if($request->file('dwg_customer')) {
            if ($tool->dwg_customer) {
                Storage::delete($tool->dwg_customer);
            }

            $fileName = $request['drawing'] . '_customer' . '.' . $request->file('dwg_customer')->extension();
            $validatedData['dwg_customer'] = $request->file('dwg_customer')->storeAs('dwg_customer', $fileName);
        }

        if($request->file('dwg_production')) {
            if ($tool->dwg_production) {
                Storage::delete($tool->dwg_production);
            }
            
            $fileName = $request['drawing'] . '_produksi' . '.' . $request->file('dwg_production')->extension();
            $validatedData['dwg_production'] = $request->file('dwg_production')->storeAs('dwg_production', $fileName);
        }

        Tool::where('drawing', $tool->drawing)->update($validatedData);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        if($tool->dwg_customer) {
            Storage::delete($tool->dwg_customer);
        }

        if($tool->dwg_production) {
            Storage::delete($tool->dwg_production);
        }

        Tool::destroy($tool->id);
        
        return redirect('/tool')->with('success', 'Data berhasil dihapus');
    }

    public function table() {
        return view('tools.table', [
            'tools' => Tool::all(),
        ]);
    }
}

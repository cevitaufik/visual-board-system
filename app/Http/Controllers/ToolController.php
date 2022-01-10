<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index()
    {
        return view('tools.index', [
            // 'tools' => Tool::all()
            'tools' => Tool::with('flowProcesses')->get()
        ]);
    }

    public function create()
    {
        return view('tools.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'cust_code' => ['required', 'max:3'],
            'drawing' => ['required', 'max:13', 'unique:tools'],
            'description' => ['required', 'max:255'],
            'status' => 'required',
        ];

        $request['cust_code'] = strtoupper($request['cust_code']);
        $request['drawing'] = strtoupper($request['drawing']);

        if(isset($request['note'])) {
            $rules['note'] = ['max:500'];
        }

        if($request['code'] != null) {
            $rules['code'] = ['max:255'];
            $request['code'] = strtoupper($request['code']);
        } else {
            $code = substr($request->drawing, 0, 10);
            $validatedData['code'] = $code;
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

    public function update(Request $request, Tool $tool)
    {
        $rules = [
            'drawing' => ['required', 'max:13'],
            'code' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'status' => 'required',
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

        $dwg = $request['drawing'];
        return redirect('/tool/' . $dwg)->with('success', 'Data berhasil diperbarui');
    }

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

    public function getDrawing($toolCode, $cust) {
        $data = Tool::where('cust_code', '=', $cust)
                    ->where('code', '=', $toolCode)
                    ->orderBy('drawing', 'desc')
                    ->first();

        if($data) {
            return $data->drawing;
        } else {
            return '';
        }
    }
}

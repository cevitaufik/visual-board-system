<?php

namespace App\Http\Controllers;

use App\Models\WorkCenter;
use Illuminate\Http\Request;

class WorkCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('work-centers.index', [
            'workCenters' => WorkCenter::all()->sortBy('code'),
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

    public function store(Request $request)
    {
        $rules = [
            'description' => ['required'],
            'code' => ['required', 'unique:work_centers']
        ];

        $validatedData = $request->validate($rules);
        $validatedData['code'] = strtoupper($validatedData['code']);
        $validatedData['description'] = ucfirst($validatedData['description']);

        WorkCenter::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkCenter  $workCenter
     * @return \Illuminate\Http\Response
     */
    public function show(WorkCenter $workCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkCenter  $workCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkCenter $workCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkCenter  $workCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkCenter $workCenter)
    {
        $rules = [
            'description' => ['required'],
        ];

        if($request->code != $workCenter->code) {
            $request['code'] = strtoupper($request['code']);
            $rules['code'] = ['required', 'unique:work_centers'];
        }

        $validatedData = $request->validate($rules);
        
        $validatedData['description'] = ucfirst($validatedData['description']);

        WorkCenter::where('id', $workCenter->id)->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkCenter  $workCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkCenter $workCenter)
    {
        WorkCenter::destroy($workCenter->id);

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}

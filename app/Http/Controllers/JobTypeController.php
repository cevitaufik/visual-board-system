<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job-types.index', [
            'jobTypes' => JobType::all(),
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
        $rules = [
            'description' => ['required'],
            'code' => ['required', 'unique:job_types']
        ];

        $validatedData = $request->validate($rules);

        JobType::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function show(JobType $jobType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function edit(JobType $jobType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobType $jobType)
    {
        $rules = [
            'description' => ['required'],
        ];

        if($request->code != $jobType->code) {
            $rules['code'] = ['required', 'unique:job_types'];
        }

        $validatedData = $request->validate($rules);

        JobType::where('id', $jobType->id)->update($validatedData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobType $jobType)
    {
        JobType::destroy($jobType->id);

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}

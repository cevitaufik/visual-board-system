<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
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

    public function destroy(JobType $jobType)
    {
        JobType::destroy($jobType->id);

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}

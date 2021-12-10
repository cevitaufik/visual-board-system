<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index', [
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:customers'],
            'phone' => ['required', 'unique:customers'],
            'address' => ['required', 'max:225'],
        ];

        $validatedData = $request->validate($rules);

        $code = strtoupper(substr($request->name, 0, 3));

        if(!Customer::where('code', $code)->value('code')) {
            $validatedData['code'] = $code;
        } else {
            $chars = strtoupper(substr($request->name, 0, 2));
            $cleanedChars = str_replace(' ', '', strtoupper(substr($request->name, 3)));
            $arr = str_split($cleanedChars);

            foreach ($arr as $lastChar) {
                if (!Customer::where('code', $chars . $lastChar)->value('code')) {
                    $validatedData['code'] = $chars . $lastChar;
                    break;
                }
            }
        }

        Customer::create($validatedData);

        return redirect('/customer')->with('success', 'Data customer berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function table() {
        return view('customers.table', [
            'customers' => Customer::all(),
        ]);
    }
}

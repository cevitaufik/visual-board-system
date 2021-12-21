<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContact;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index', [
            'customers' => Customer::all(),
        ]);
    }


    public function create()
    {
        return view('customers.create');
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:customers'],
            'phone' => ['required', 'unique:customers'],
            'address' => ['required', 'max:225'],
        ];

        $request['name'] = strtoupper($request->name);

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

        if (isset($request->contact_person)) {
            foreach ($request->contact_person as $person) {

                $contact['cust_code'] = $validatedData['code'];
                $contact['name'] = $person['name'];
                $contact['position'] = $person['position'];
                $contact['email'] = implode(',', $person['email']);
                $contact['phone'] = implode(',', $person['phone']);

                CustomerContact::create($contact);
            }
        }        

        return redirect('/customer')->with('success', 'Data customer berhasil ditambahkan');
    }

    public function show(Customer $customer)
    {
        return view('customers.detail', ['customer' => $customer]);
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


    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:225'],
        ];

        $request['name'] = strtoupper($request->name);

        if ($request['email'] != $customer->email) {
            $rules['email'] = ['required', 'email:dns', 'unique:customers'];
        }

        if ($request['phone'] != $customer->phone) {
            $rules['phone'] = ['required', 'unique:customers'];
        }

        $validatedData = $request->validate($rules); 
        Customer::where('code', $customer->code)->update($validatedData);

        return redirect('/customer/' . $customer->code)->with('success', 'Data customer berhasil diperbarui');
    }


    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
        return redirect('/customer')->with('success', 'Data berhasil dihapus');        
    }

    public function table() {
        return view('customers.table', [
            'customers' => Customer::all(),
        ]);
    }

    public function addContact(Request $request) {
        $contact['cust_code'] = $request['cust_code'];
        $contact['name'] = $request['name'];
        $contact['email'] = implode(',', $request['email']);
        $contact['phone'] = implode(',', $request['phone']);
        $contact['position'] = $request['position'];

        CustomerContact::create($contact);
        return redirect()->back()->with('success', 'Kontak berhasil ditambahkan.');
    }

    public function deleteContact($id) {
        CustomerContact::destroy($id);
        return redirect()->back()->with('success', 'Kontak berhasil dihapus.');
    }

    public function contactDetail($id) {
        $contact = CustomerContact::where('id', $id)->first();

        return view('customers.contact-detail', ['contact' => $contact]);
    }

    public function editContact(Request $request, $id) {
        $contact['cust_code'] = $request['cust_code'];
        $contact['name'] = $request['name'];

        if (isset($request['email'])) {
            $contact['email'] = implode(',', $request['email']);
        } else {
            $contact['email'] = null;
        }
        
        if (isset($request['phone'])) {
            $contact['phone'] = implode(',', $request['phone']);
        } else {
            $contact['phone'] = null;
        }
        
        $contact['position'] = $request['position'];

        CustomerContact::where('id', $id)->update($contact);

        return redirect()->back()->with('success', 'Kontak berhasil diperbarui.');
    }
}

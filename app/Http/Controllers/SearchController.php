<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\JobType;
use App\Models\Order;
use App\Models\Tool;

class SearchController extends Controller
{
    private string $filter;
    private string $keyword;

    function __construct(){
        $this->filter = (request('filter')) ?? 'order';
        $this->keyword = (request('keyword')) ?? '';
    }

    function order() {
        return view('dashboard', [
            
            'jobTypes' => JobType::all(),
            'orders' => Order::latest()
                                ->filter($this->keyword)
                                ->get(),
        ]);
    }

    function drawing() {
        return view('tools.index', [
            'tools' => Tool::filter($this->keyword)
                                ->orderBy('cust_code', 'asc')
                                ->get()
        ]);
    }

    function customer() {
        return view('customers.index', [
            'customers' => Customer::filter($this->keyword)
                                        ->orderBy('code', 'asc')
                                        ->get()
        ]);
    }

    public function search() {
        if ($this->filter == '') {
            return back();
        } else {
            $fltr = $this->filter;
            return $this->$fltr();
        }
    }
}

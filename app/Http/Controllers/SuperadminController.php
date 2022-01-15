<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use App\Models\Order;

class SuperadminController extends Controller
{
    public function index()
    {

        if (auth()->user()->position != 'superadmin') {
            abort(403);
        }

        return view('dashboard', [
            'orders' => Order::where('current_process', '<>', 'close')
                                ->orWhere('current_process', '=', null)
                                ->latest()
                                ->get(),
            'jobTypes' => JobType::all(['code']),
        ]);
    }

    public function table() {
        return view('layouts.dashboard-table', [
            'orders' => Order::where('current_process', '<>', 'close')
            ->orWhere('current_process', '=', null)
            ->latest()
            ->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        return view('test.index');
    }

    public function qrIndex() {
        return view('test.qrIndex');
    }

    public function generateQR($input) {
        return view('test.generateQR', ['input' => $input]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\SystemMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function confirmation() {
        $detailS = [
            'title' => 'Email konfirmasi',
            'body' => 'ini adalah email konfirmasi'
        ];

        Mail::to('cevitaufik@gmail.com')->send(new SystemMail($detailS));
    }
}

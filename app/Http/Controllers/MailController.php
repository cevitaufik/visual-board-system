<?php

namespace App\Http\Controllers;

use App\Mail\SystemMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function confirmation() {
        $message = [
            'title' => 'Email konfirmasi',
            'body' => 'Ini adalah email konfirmasi.'
        ];

        Mail::to('cevitaufik@gmail.com')->queue(new SystemMail($message));
        // return new SystemMail($message);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/bf9yXfMVxc43Z5TVF54kcujAJG4sRQ7JTG5udmCw3Ts3mrEwqHBCM8Mx6kFzTQcj/webhook',
    ];
}

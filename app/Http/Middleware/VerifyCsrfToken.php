<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'digi-flazz/price-list',
        'digi-flazz/cek-saldo',
        'digi-flazz/deposit',
        'digi-flazz/callback',
    ];
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PackagesController extends Controller
{
    /**
     * Method index
     *
     * @return View
     */
    public function index():View
    {
        return view('dashboard.pages.packages.index');
    }
}

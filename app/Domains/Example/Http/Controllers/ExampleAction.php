<?php

namespace App\Domains\Example\Http\Controllers;

use App\Http\Controllers\Controller;

class ExampleAction extends Controller
{
    public function index()
    {
        return view('example_view::index');
    }
}

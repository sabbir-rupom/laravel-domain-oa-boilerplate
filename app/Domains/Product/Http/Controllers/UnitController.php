<?php

namespace App\Domains\SimplePage\Http\Controllers;

use App\Domains\SimplePage\Models\Unit;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::modifyValue(
            Unit::orderBy('name', 'asc')->get()
        );

        return view('simple_page_view::index', [
            'units' => $units,
            'heads' => Unit::unitHeads(),
        ]);
    }
}

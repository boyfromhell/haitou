<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class VisitorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:visitantes-mod');
    }

    public function index()
    {
        return view('staff.visitors.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PressureMeasurementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Показать форму для создания нового измерения.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pressure_measurements.create');
    }
}

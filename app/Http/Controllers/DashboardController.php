<?php

namespace App\Http\Controllers;

use App\Charts\JumlahBarangChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(JumlahBarangChart $jumlahBarangChart)
    {
        return view('dashboard', ['jumlahBarangChart' => $jumlahBarangChart->build()]);
    }
}

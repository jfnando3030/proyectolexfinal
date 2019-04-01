<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard()
    {
    	$total_afiliados = User::all();
    	return $total_afiliados;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilToko;
use Illuminate\Http\Request;
use App\Models\Parfum;

class DashboardController extends Controller
{
public function index()
{
    $labelStats = [
        'best_seller' => Parfum::where('label','best_seller')->count(),
        'new'         => Parfum::where('label','new')->count(),
        'limited'     => Parfum::where('label','limited')->count(),
        'promo'       => Parfum::where('label','promo')->count(),
    ];

    $profilToko = ProfilToko::first();

    return view('admin.dashboard', compact('labelStats','profilToko'));
}

}

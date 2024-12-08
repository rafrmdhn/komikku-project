<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Komik;
use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'komik' => Komik::count(),
            'pembelian' => DetailPembelian::count(),
            'pengguna' => User::where('id', '!=', auth()->user()->id)->count()
        ]);
    }
}

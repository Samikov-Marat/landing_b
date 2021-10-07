<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index()
    {
        $tariffs = Tariff::select('id','ek_id', 'tariff_type_id')->paginate(10);
        return view('admin.tariffs.index', ['tariffs' => $tariffs]);
    }
}

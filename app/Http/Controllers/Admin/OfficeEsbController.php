<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Admin\OfficeEsbMass;
use App\Http\Controllers\Controller;
use App\OfficeUuid;
use Illuminate\Http\Request;

class OfficeEsbController extends Controller
{
    public function index(Request $request)
    {
        $showMessage = $request->input('loaded', '0') == '1';

        return view('admin.office_esb.index')
            ->with('showMessage', $showMessage)
            ->with('officeUuidCount', OfficeUuid::count());
    }


    public function save(Request $request)
    {
        $file = $request->file('file')->store('/office_esb');
        app(OfficeEsbMass::class, ['file' => $file])
            ->process();
        return response()->redirectToRoute('admin.office_esb.index', ['loaded' => 1]);
    }

}

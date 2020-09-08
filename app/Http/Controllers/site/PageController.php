<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showPage(Request $request, $page = null){
        $site = $request->server('HTTP_HOST');
        dump($page);
    }
}

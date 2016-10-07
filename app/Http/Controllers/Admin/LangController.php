<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LangController extends Controller
{
    /**
     * Change locale.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang='en')
    {
        App::setLocale($lang);
        session(['lang'=> $lang]);
        return redirect('admin/category');
    }
}

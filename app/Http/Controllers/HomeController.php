<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Category;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id = null) {
        App::setLocale(session('lang','en'));
        $current = '';
        if ($category_id) {
            $current= new Category();
            $current = $current->find($category_id);
        }
        return view('home', ['current'=>$current]);
    }

}

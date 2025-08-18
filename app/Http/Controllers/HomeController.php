<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = DB::table('product')
            ->select('*')
            ->get();

        return view('frontend.index',
            [
                'product'=>$data,
            ]);

    }
    public function shop(){
        $data = DB::table('product')
            ->select('*')
            ->get();

        return view('frontend.shop',
            [
                'product'=>$data,
            ]);
    }
}

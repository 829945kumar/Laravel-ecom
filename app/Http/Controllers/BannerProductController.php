<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerProduct;
use App\Models\TodayDeals;

class BannerProductController extends Controller
{
    public function store(){

        $record = BannerProduct::all();

        return view ('home',  ['product' => $record]);
    }

    public function productDetail( $id){
        $pdata = TodayDeals::find($id);
        return view('product-detail',['prodect'=>$pdata]);

    }
}


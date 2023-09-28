<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usermodel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\CartModel;
use App\models\TodayDeals;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show( Request $req ){

        $data = Usermodel::where(['email'=> $req->email])->first();
        if( !$data || !Hash::check($req->password, $data->password)){
            return "user email and password are not correct";
        }

        else{

            $req->session()->put('user', $data);
            return redirect('/');
        }

    }

    public function save(){

        return view('login');

    }

    public function addtocart( Request $request){

        if ($request->session()->has('user')){
            $cart = new CartModel();
            $cart->customer_id = $request->session()->get('user')['id'];
            $cart->product_id = $request->product_id;
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/login');
        }

    }

    public function cartProdectDetail(){

        $customer_id = session()->get('user')['id'];

        $users = DB::table('add_to_cart')
        ->join('today_deals', 'add_to_cart.product_id', '=', 'today_deals.id')
        ->select('add_to_cart.product_id', DB::raw('COUNT(*) as cart_count'), 'today_deals.address', 'today_deals.product_name', 'today_deals.cost', 'today_deals.description')
        ->where('add_to_cart.customer_id', '=', $customer_id)
        ->groupBy('add_to_cart.product_id', 'today_deals.address', 'today_deals.product_name', 'today_deals.cost', 'today_deals.description')
        ->get();
        return view('addToCart',['cartProduct'=> $users ]);

    }
}

<?php

use Illuminate\Http\Request;
use Larashop\Models\OrderDetail;
use Larashop\Models\Order;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/order', function (Request $request) {
	
	//get order info with set id	
//	$order = Order::where('id', $request['id'])->get()->toArray(); 
	
	//get order_details info with set id
//	$orderdetails = OrderDetail::where('order_id', $request['id'])->get()->toArray();
    
	//return order info and all order_details associated with that order
//    return Response::json(array('order'=>$order,'order_details'=>$orderdetails));

//});
	//$orderdetails = OrderDetail::where('order_id', $request['id'])->with('order')->get();
	

//Route::get('/orderdetails', function (Request $request) {
//	$orderdetails = OrderDetail::where('id', $request['id'])->first();
//    return Response::json($orderdetails);
//});
	

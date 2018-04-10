<?php

namespace Larashop\Http\Controllers\Admin;


use Larashop\Models\OrderDetail;
use Larashop\Models\Order;

use Larashop\Models\Product;
use Illuminate\Http\Request;
use Larashop\Models\Category;
use Larashop\Http\Controllers\Controller;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    		$id = $_GET['id'];
            $orderdetails = OrderDetail::where('order_id', $id)->get();
			$orders = Order::all();
			$products = Product::all();
			
			
            $params = [
                'title' => 'Orders Listing',
                'orderdetails' => $orderdetails,
                'orders' => $orders,
                'products' => $products,
                
            ];

            return view('admin.orderdetails.orderdetails_list')->with($params);
	}
	
	public function create()
    {
    	
        $orders = Order::all();
		$products = Product::all();
		$orderdetails = OrderDetail::all();
		
		$params = [
			'title' => 'New Order',
			'orders' => $orders,
			'products' => $products,
			'orderdetails' => $orderdetails,
		];
		
		return view('admin.orderdetails.orderdetails_create')->with($params);
    }
    
	public function store(Request $request)
    {
		$this->validate($request, [
		'order_number' => 'required',
		//'date_order' => 'required',
		//'delivery_date' => 'required',
		//'partner_id' => 'required',
		//'total_amount' => 'required',
		//'status' => 'required',
		'product_id_1' => 'required',
		'qty_1' => 'required',
		]);
		
		//check totals for multiple items
		$product_price = Product::where('id', $request->input('product_id_1'))->first();
		$price = $product_price->price;
		$total_price = $price * $request->input('qty_1');
		

		$orderdetails = OrderDetail::create([
		'order_id' => $request->input('order_number'),
		'product_id' => $request->input('product_id_1'),
		'quantity' => $request->input('qty_1'),
		'price' => $price,
		'sub_total' => $total_price,
		]);
		
		$order_total = OrderDetail::where('order_id', $request->input('order_number'))->sum('sub_total');
		
		$order = Order::where('id', $request->input('order_number'))->first();
		$order->total_amount =$order_total;
		$order->save();
		
		return redirect()->route('orders.index')->with('success', "The item has been added successfully.");
    }

	public function show($id)
    {
        $orderdetail = OrderDetail::find($id);
		
		$params = [
			'title' => 'Delete Item',
			'orderdetail' => $orderdetail,
		];
		
		return view('admin.orderdetails.orderdetails_delete')->with($params);
    }
	
	public function edit($id)
    {
		$orderdetail = OrderDetail::find($id);
		$orders = Order::all();
		//$customers = Customer::all();
		
        $products = Product::all();
		
		$params = [
			'title' => 'Edit Item',
			'orders' => $orders,
			//'customers' => $customers,
			'orderdetail' => $orderdetail,
            'products' => $products,
		];
		
		return view('admin.orderdetails.orderdetails_edit')->with($params);
    }

	public function update(Request $request, $id)
    {
        $orderdetail = OrderDetail::find($id);

        if (!$orderdetail){
            return redirect()
                ->route('orders.index')
                ->with('warning', 'The order you requested for has not been found.');
        }
		
		$this->validate($request, [
		//'order_number' => 'required|unique:orders,order_number,'.$id,
		//'date_order' => 'required',
		//'delivery_date' => 'required',
		//'partner_id' => 'required',
		//'total_amount' => 'required',
		//'status' => 'required',
		'product_id_1' => 'required',
		'qty_1' => 'required',
		]);
		
		$product_price = Product::where('id', $request->input('product_id_1'))->first();
		$price = $product_price->price;
		$total_price = $price * $request->input('qty_1');
		
		$orderdetail->product_id = $request->input('product_id_1');
		$orderdetail->quantity = $request->input('qty_1');
		$orderdetail->sub_total = $total_price;
		
		$orderdetail->save();
		
		//update total
		$order_total = OrderDetail::where('order_id', $orderdetail->order_id)->sum('sub_total');
		
		$order = Order::where('id', $orderdetail->order_id)->first();
		$order->total_amount =$order_total;
		$order->save();
		
		
		return redirect()->route('orders.index')->with('success', "Order number <strong>$order->order_number</strong> has successfully been updated.");
		
    }
	
	public function destroy($id)
    {
        $orderdetail = OrderDetail::find($id);
		

        if (!$orderdetail){
            return redirect()
                ->route('orders.index')
                ->with('warning', 'The item you requested for has not been found.');
        }
		
		
        $orderdetail->delete();
		
		$order_total = OrderDetail::where('order_id', $orderdetail->order_id)->sum('sub_total');
		
		$order = Order::where('id', $orderdetail->order_id)->first();
		$order->total_amount =$order_total;
		$order->save();

        return redirect()->route('orders.index')->with('success', "Item has been deleted.");
    }
}
    
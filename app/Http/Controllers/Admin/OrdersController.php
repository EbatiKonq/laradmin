<?php

namespace Larashop\Http\Controllers\Admin;

use Larashop\Models\Customer;
use Larashop\Models\OrderDetail;
use Larashop\Models\Order;
use Larashop\Models\Brand;
use Larashop\Models\Product;
use Illuminate\Http\Request;
use Larashop\Models\Category;
use Larashop\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $orders = Order::all();
			$customers = Customer::all();
			
			
            $params = [
                'title' => 'Orders Listing',
                'orders' => $orders,
                'customers' => $customers,
                
            ];

            return view('admin.orders.orders_list')->with($params);
	}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
		$products = Product::all();
		
		$params = [
			'title' => 'New Order',
			'customers' => $customers,
			'products' => $products,
		];
		
		return view('admin.orders.orders_create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
		'order_number' => 'required|unique:orders',
		//'date_order' => 'required',
		'delivery_date' => 'required',
		'partner_id' => 'required',
		//'total_amount' => 'required',
		//'status' => 'required',
		'product_id_1' => 'required',
		'qty_1' => 'required',
		]);
		
		//check totals for multiple items
		$product_price = Product::where('id', $request->input('product_id_1'))->first();
		$price = $product_price->price;
		$total_price = $price * $request->input('qty_1');
		
		
		$order = Order::create([
		'order_number' => $request->input('order_number'),
		'date_order' => date('Y-m-d H:i:s'),
		'delivery_date' => $request->input('delivery_date'),
		'partner_id' => $request->input('partner_id'),
		'total_amount' => $total_price,
		'currency_id' => "EUR",
		'uploaded' => '0',
		]);
		
		//get order id to insert into order_details
		$order_id = Order::where('order_number', $request->input('order_number'))->first();
		$id = $order_id->id;
		
		
		$orderdetails = OrderDetail::create([
		'order_id' => $id,
		'product_id' => $request->input('product_id_1'),
		'quantity' => $request->input('qty_1'),
		'price' => $price,
		'sub_total' => $total_price,
		]);
		
		return redirect()->route('orders.index')->with('success', "The order has been created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
		
		$params = [
			'title' => 'Delete Order',
			'order' => $order,
		];
		
		return view('admin.orders.orders_delete')->with($params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$order = Order::find($id);
		$orderdetails = OrderDetail::all();
		$customers = Customer::all();
		$brands = Brand::all();
        $categories = Category::all();
        $product = Product::all();
		
		$params = [
			'title' => 'Edit Order',
			'order' => $order,
			'customers' => $customers,
			'orderdetails' => $orderdetails,
			'brands' => $brands,
            'categories' => $categories,
            'product' => $product,
		];
		
		return view('admin.orders.orders_edit')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order){
            return redirect()
                ->route('orders.index')
                ->with('warning', 'The order you requested for has not been found.');
        }
		
		$this->validate($request, [
		'order_number' => 'required|unique:orders,order_number,'.$id,
		//'date_order' => 'required',
		'delivery_date' => 'required',
		'partner_id' => 'required',
		//'total_amount' => 'required',
		//'status' => 'required',
		//'product_id_1' => 'required',
		//'qty_1' => 'required',
		]);
		
		$order->order_number = $request->input('order_number');
		$order->delivery_date = $request->input('delivery_date');
		$order->partner_id = $request->input('partner_id');
		
		$order->save();
		
		return redirect()->route('orders.index')->with('success', "Order number <strong>$order->order_number</strong> has successfully been updated.");
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
		

        if (!$order){
            return redirect()
                ->route('orders.index')
                ->with('warning', 'The order you requested for has not been found.');
        }
		
		$orderdetail = OrderDetail::where('order_id', $id)->delete();
        $order->delete();
		

        return redirect()->route('orders.index')->with('success', "Order number <strong>$order->order_number</strong> has successfully been archived.");
    }
    }
    
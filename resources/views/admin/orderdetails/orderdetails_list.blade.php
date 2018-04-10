@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Order Details <a href="{{route('orderdetails.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> New Item </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        	
                            <tr>
                                <th>Order ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub-Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Order ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sub-Total</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($orderdetails))
                            @foreach($orderdetails as $row)
                            <tr>
                                <td>{{$row->order_id}}</td>
                                <td>{{$products[$row->product_id - 1]->product_name}}</td>
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->price}}</td>
                                <td>{{$row->sub_total}}</td>
                                @if($orders[$_GET['id'] - 1]['uploaded'] == 1)
                                <td>Order uploaded</td>
                                @else
                                <td>
                                    <a href="{{ route('orderdetails.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit Quantity"></i> </a>
                                    <a href="{{ route('orderdetails.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
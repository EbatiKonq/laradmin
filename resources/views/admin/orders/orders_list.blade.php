@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Customer Orders <a href="{{route('orders.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> New Order </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Order Creation Date</th>
                                <th>Delivery Date</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Order #</th>
                                <th>Order Creation Date</th>
                                <th>Delivery Date</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($orders))
                            @foreach($orders as $row)
                            <tr>
                                <td>{{$row->order_number}}</td>
                                <td>{{$row->date_order}}</td>
                                <td>{{$row->delivery_date}}</td>
                                <td>{{$customers[$row->partner_id - 1]->name}}</td>
                                <td>{{$row->total_amount}}</td>
                                @if($row->uploaded == 0)
                                <td>
                                    <a href="{{ route('orders.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                    <a href="{{ route('orders.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    <a href="{{ route('orderdetails.index', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Products"></i> </a>
                                </td>
                                @else
                                <td>Order is uploaded <a href="{{ route('orderdetails.index', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Products"></i> </a></td>
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
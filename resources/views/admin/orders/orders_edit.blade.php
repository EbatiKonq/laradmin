@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Order <a href="{{route('orders.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('orders.update', ['id' => $order->id]) }}" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group{{ $errors->has('order_number') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_code">Order Number <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="{{$order->order_number}}" id="order_number" name="order_number" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('order_number'))
                                <span class="help-block">{{ $errors->first('order_number') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('delivery_date') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="delivery_date">Delivery date <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" value="{{$order->delivery_date}}" id="delivery_date" name="delivery_date" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('delivery_date'))
                                <span class="help-block">{{ $errors->first('delivery_date') }}</span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('partner_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="partner_id">Customer<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="partner_id" name="partner_id">
                                    @if(count($customers))
                                    @foreach($customers as $row)
                                    <option value="{{$row->id}}" {{$row->id == $order->partner_id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('partner_id'))
                                <span class="help-block">{{ $errors->first('partner_id') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-success">Save Product Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
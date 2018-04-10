@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Item <a href="{{route('orders.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('orderdetails.update', ['id' => $orderdetail->id]) }}" data-parsley-validate class="form-horizontal form-label-left">


<div class="form-group{{ $errors->has('product_id_1') ? ' has-error' : '' }}">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_id_1">Product <span class="required">*</span></label>
		<div class="col-md-4 col-sm-4 col-xs-4">
			<select class="form-control" value="{{$orderdetail->product_id}}" id="product_id_1" name="product_id_1">
				@if(count($products))
					@foreach($products as $row)
						<option value="{{$row->id}}">{{$row->product_name}}</option>
					@endforeach
				@endif
			</select>
				@if ($errors->has('product_id_1'))
					<span class="help-block">{{ $errors->first('product_id_1') }}</span>
                @endif
         </div>
			<div class="form-group{{ $errors->has('qty_1') ? ' has-error' : '' }}">
				<div class="col-md-2 col-sm-2 col-xs-2">
					<input type="text" placeholder="Qty" value="{{ Request::old('qty_1') ?: '' }}" id="qty_1" name="qty_1" class="form-control col-md-7 col-xs-12">
						@if ($errors->has('qty_1'))
							<span class="help-block">{{ $errors->first('qty_1') }}</span>
						@endif
				</div>
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
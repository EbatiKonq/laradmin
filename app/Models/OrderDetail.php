<?php

namespace Larashop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

	protected $table = 'order_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'sub_total',
    ];
	
	/**         * Get the order that the orderdetail belongs to.         */ 

      public function order()        { 

          return $this->belongsTo('Larashop\Models\Order','order_id','id'); 

      }
	  
	  public function product(){
	  	
		return $this->hasMany('Larashop\Models\Product','product_id');
		
	  }
}

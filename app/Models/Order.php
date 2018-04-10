<?php

namespace Larashop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

	protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'date_order',
        'delivery_date',
        'partner_id',
        'total_amount',
        'currency_id',
        'uploaded',
    ];
	
	/**         * Get the orderdetails for the order.         */

        public function orderdetails()        {           

			return $this->hasMany('Larashop\Models\OrderDetail','order_id');

        }

/**         * Get the customer that the order belongs to.         */ 

      public function customer()     { 

          return $this->belongsTo('Larashop\Models\Customer','id');     

     }
}

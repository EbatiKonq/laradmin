<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number')->unique();
			$table->date('date_order');
            $table->date('delivery_date');
            $table->integer('partner_id')->unsigned()->index();
            $table->float('total_amount');
			$table->string('currency_id');
            $table->boolean('uploaded');
            $table->timestamps();
            $table->softDeletes();
			
            $table->foreign('partner_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

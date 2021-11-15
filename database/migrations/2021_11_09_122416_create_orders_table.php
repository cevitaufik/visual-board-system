<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('po_number');
            $table->integer('shop_order')->unique();
            $table->string('cust_code');
            $table->string('description')->nullable();
            $table->string('note')->nullable();
            $table->string('tool_code')->nullable();
            $table->integer('quantity');
            $table->string('dwg_number')->nullable();
            $table->string('job_type')->nullable();
            $table->date('due_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('current_process')->nullable();
            $table->timestamps();
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

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
        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('tools', function (Blueprint $table) {
            $table->id('id');
            $table->string('cust_code');
            $table->string('code');
            $table->string('description')->nullable();
            $table->string('drawing')->unique();
            $table->string('note')->nullable();
            $table->string('dwg_production')->nullable();
            $table->string('dwg_customer')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number');
            $table->integer('shop_order')->unique();
            $table->string('cust_code');
            $table->string('description')->nullable();
            $table->string('note')->nullable();
            $table->string('tool_code')->nullable();
            $table->integer('quantity');
            $table->string('no_drawing')->nullable();

            $table->string('job_type_code');

            $table->date('due_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('current_process')->nullable();
            $table->timestamps();

            $table->foreign('job_type_code')->references('code')->on('job_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('no_drawing')->references('drawing')->on('tools')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(['orders', 'job_types']);
    }
}

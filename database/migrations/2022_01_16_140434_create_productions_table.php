<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->integer('no_shop_order');
            $table->integer('subprocess');
            $table->integer('op');
            $table->integer('additional');
            $table->string('work_center');
            $table->integer('estimation');
            $table->text('instruction');
            $table->dateTime('start');
            $table->dateTime('finish');
            $table->integer('process_time');
            $table->string('operator');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('productions');
    }
}

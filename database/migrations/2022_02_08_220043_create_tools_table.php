<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public static function crecreateTable() {
        Schema::create('tools', function (Blueprint $table) {
            $table->id('id');
            $table->string('cust_code');
            $table->string('code');
            $table->string('description')->nullable();
            $table->string('drawing')->unique();
            $table->string('status')->nullable();
            $table->string('note')->nullable();
            $table->string('dwg_production')->nullable();
            $table->string('dwg_customer')->nullable();
            $table->timestamps();
        });
    }
}


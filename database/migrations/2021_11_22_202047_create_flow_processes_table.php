<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('flow_processes', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('flow_processes');
    }

    public static function createTable() {
        Schema::create('flow_processes', function (Blueprint $table) {
            $table->id();
            $table->string('no_drawing');
            $table->text('process');
            $table->timestamps();
            $table->foreign('no_drawing')->references('drawing')->on('tools')->onDelete('cascade')->onUpdate('cascade');
        });

    }
}

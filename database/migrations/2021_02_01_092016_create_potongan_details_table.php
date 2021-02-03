<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotonganDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potongan_details', function (Blueprint $table) {        
            $table->increments('potongan_pegawai_id');
            $table->unsignedBigInteger('potongan_id');
            $table->integer('besar_potongan');
            $table->integer('banyak_hari_potongan');
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
        Schema::dropIfExists('potongan_details');
    }
}

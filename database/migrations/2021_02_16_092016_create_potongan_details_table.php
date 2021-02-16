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
        $tableNames = config('permission.table_names');

        Schema::create('potongan_details', function (Blueprint $table) use ($tableNames) {        
            $table->id();
            $table->unsignedBigInteger('potongan_pegawai_id');
            $table->unsignedBigInteger('potongan_id');            
            $table->integer('besar_potongan');
            $table->integer('banyak_hari_potongan');
            $table->timestamps();

            $table->foreign('potongan_id')
                ->references('id')
                ->on('potongans')
                ->onDelete('cascade');
            $table->foreign('potongan_pegawai_id')
                ->references('pegawai_id')
                ->on('potongan_pegawais')
                ->onDelete('cascade');
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

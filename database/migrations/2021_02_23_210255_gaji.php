<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Gaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->integer('gaji_pokok')->nullable();
            $table->integer('total_tunjangan')->nullable();
            $table->integer('bonus')->default(0);
            $table->date('period');
            $table->timestamps();

            $table->foreign('pegawai_id')
                ->references('id')
                ->on('pegawais')
                ->onDelete('cascade');
            // $table->foreign('total_tunjangan')
            //     ->references('id')
            //     ->on('tunjangans')
            //     ->onDelete('SET NULL');
            // $table->foreign('total_potongan')
            //     ->references('id')
            //     ->on('potongans')
            //     ->onDelete('SET NULL');
        });

        Schema::create('detail_tunjangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gaji_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('tunjangan_id');
            $table->date('tanggal');
            $table->integer('besar_tunjangan');
            $table->timestamps();

            $table->foreign('gaji_id')
                ->references('id')
                ->on('gajis')
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
        Schema::dropIfExists('gajis');
    }

}

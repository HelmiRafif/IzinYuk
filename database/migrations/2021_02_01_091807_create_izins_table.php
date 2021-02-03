<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('keterangan');
            $table->string('type_izin');
            $table->string('status_diterima');
            $table->unsignedBigInteger('pegawai_id');
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
        Schema::dropIfExists('izins');
    }
}

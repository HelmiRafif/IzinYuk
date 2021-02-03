<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('nama');
            $table->string('email')->unique();
            $table->text('alamat')->nullable($value = true);
            $table->date('tanggal_masuk');
            $table->string('rekening')->nullable($value = true);
            $table->string('type_pegawai')->nullable($value = true);
            $table->unsignedBigInteger('bank_id')->nullable($value = true);
            $table->unsignedBigInteger('jabatan_id')->nullable($value = true);
            $table->integer('bonus_loyalitas')->nullable($value = true);
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
        Schema::dropIfExists('pegawais');
    }
}

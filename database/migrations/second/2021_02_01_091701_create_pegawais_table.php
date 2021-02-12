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
            $table->id(); 
            $table->string('nama');
            $table->string('email')->unique();
            $table->text('alamat')->nullable($value = true);
            $table->date('tanggal_masuk');
            $table->string('rekening')->nullable($value = true);
            $table->string('type_pegawai')->nullable($value = true);
            $table->unsignedBigInteger('bank_id')->nullable($value = true);
            $table->unsignedBigInteger('jabatan_id');
            $table->integer('bonus_loyalitas')->nullable($value = true);
            $table->timestamps();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatans')
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
        Schema::dropIfExists('pegawais');
    }
}

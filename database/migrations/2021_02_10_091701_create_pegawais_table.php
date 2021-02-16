<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

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
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->text('alamat')->nullable($value = true);
            $table->date('tanggal_masuk')->nullable();
            $table->string('rekening')->nullable($value = true);
            $table->string('type_pegawai')->nullable($value = true);
            $table->unsignedBigInteger('bank_id')->nullable($value = true);
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->unsignedBigInteger('bonus_loyalitas')->nullable($value = true);
            $table->timestamps();

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatans')
                ->onDelete('SET NULL');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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

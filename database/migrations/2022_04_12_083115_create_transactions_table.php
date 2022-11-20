<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->string('status_transaksi');
            $table->mediumText('notes')->nullable();
            $table->string('id_kurir')->nullable();
            $table->string('id_jenisKurir')->nullable();
            $table->string('nomorResi')->nullable();
            $table->double('totalCost')->nullable();
            $table->string('namaPembeli')->nullable();
            $table->string('emailPembeli')->nullable();
            $table->string('phonePembeli')->nullable();
            $table->double('ongkir')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->integer('durasi')->nullable();
            $table->timestamp('date_transaction')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};

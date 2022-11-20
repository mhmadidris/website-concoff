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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderID');
            $table->string('kode_order')->nullable();
            $table->foreignId('id_buyer')->constrained('users', 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_transaction')->constrained('transactions', 'id_transaction')->onDelete('cascade')->onUpdate('cascade');
            $table->string('snap_token')->nullable();
            $table->timestamp('date_order')->nullable();
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
        Schema::dropIfExists('orders');
    }
};

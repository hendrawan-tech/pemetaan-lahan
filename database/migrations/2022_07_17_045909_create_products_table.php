<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->string("stok", 6);
            $table->string("price", 8);
            $table->text("description");
            $table->string("image", 100)->nullable();
            $table->enum("status", ['Proses', 'Tersedia', 'Kosong'])->default("Proses");
            $table->enum("owner", ['Petani', 'Tengkulak', 'Pembeli'])->default("Petani");
            $table->unsignedBigInteger('plant_type_id');
            $table->foreign('plant_type_id')->references('id')->on('plant_types')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('land_id');
            $table->foreign('land_id')->references('id')->on('lands')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}

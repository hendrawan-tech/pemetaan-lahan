<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 80)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 13)->nullable();
            $table->string('address', 255)->nullable();
            $table->string("lattitude", 50)->nullable();
            $table->string("longitude", 50)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('password');
            $table->enum("role", ['Admin', 'Petani', 'Tengkulak', 'Proses', 'Pembeli'])->default("Pembeli");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

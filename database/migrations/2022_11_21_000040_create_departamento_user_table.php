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
       /*  Schema::create('departamento_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('departamento_id')->references('id')->on('departamentos')->cascadeOnDelete();;
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();;
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamento_user');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100)->unique();
            $table->string('pais',100);
            $table->unsignedBigInteger('autor_id');
            $table->foreign('autor_id')->references('id')->on('autors');
            $table->unsignedBigInteger('editora_id');
            $table->foreign('editora_id')->references('id')->on('editoras');
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->softDeletes();
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
        Schema::dropIfExists('livros');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionAdopcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_adopcions', function (Blueprint $table) {
            $table->id()->primary();
            $table->text('titulo');
            $table->longText('descripcion_corta');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('mascota_id')->constrained('mascotas');
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
        Schema::dropIfExists('publicacion_adopcions');
    }
}

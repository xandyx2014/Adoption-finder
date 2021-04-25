<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudAdopcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_adopcions', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            $table->string('descripcion');
            $table->enum('estado', ['PENDIENTE', 'ACEPTADO', 'RECHAZADO'])->default('PENDIENTE');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('publicacion_adopcion_id')->constrained('publicacion_adopcions');
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
        Schema::dropIfExists('solicitud_adopcions');
    }
}

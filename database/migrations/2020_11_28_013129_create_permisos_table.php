<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permiso_id')->constrained('permisos');
            $table->foreignId('rol_id')->constrained('rols');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('permisos');
        Schema::dropIfExists('permiso_rol');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');


    }
}

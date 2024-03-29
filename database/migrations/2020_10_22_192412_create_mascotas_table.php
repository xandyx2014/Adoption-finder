<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('SET SESSION sql_require_primary_key=0');
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('color', 20);
            $table->string('nombre', 20);
            $table->string('descripcion');
            $table->string('tamagno', 10);
            $table->string('salud', 15);
            $table->enum('genero', ['MACHO', 'HEMBRA'])->default('MACHO');
            $table->timestamp('adoptado_at')->nullable();
            $table->string('about');
            $table->boolean('adoptado')->default(0);
            $table->foreignId('raza_id')->constrained('razas');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('propetario_id')->nullable()->constrained('users');
            $table->foreignId('especie_id')->constrained('especies');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('etiqueta_mascota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas');
            $table->foreignId('etiqueta_id')->constrained('etiquetas');
            $table->softDeletes();
            $table->timestamps();
        });
        /*Schema::table('users', function (Blueprint $table) {
            $table->foreignId('mascota_id')->nullable()->constrained('mascotas');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('mascotas');
        Schema::dropIfExists('etiqueta_mascota');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //foreignId('user_id'): Esta parte está creando una columna llamada ‘user_id’ que se utilizará como clave foránea.
            // constrained(): Este método asume por defecto que la clave foránea hace referencia a una columna de id en la tabla de ‘users’. Si tu clave foránea hace referencia a una tabla diferente o a una columna diferente, puedes especificarlo dentro del método constrained(). Por ejemplo, constrained('profiles') o constrained('profiles', 'profile_id').
            // onDelete('cascade'): Esto significa que si el registro de usuario correspondiente se elimina en la tabla ‘users’, entonces todos los posts asociados a ese usuario en la tabla ‘posts’ también se eliminarán. Esto se llama eliminación en cascada.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

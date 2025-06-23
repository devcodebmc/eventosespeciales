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
        Schema::create('event_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id'); // Usa el mismo tipo que en events.id
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
                  ->onDelete('cascade');
            $table->string('image_path'); // Ruta de la imagen
            $table->integer('order')->default(1); // Orden de la imagen
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
        Schema::dropIfExists('event_images');
    }
};

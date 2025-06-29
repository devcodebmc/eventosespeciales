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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary')->nullable(); // Resumen del evento
            $table->text('content')->nullable();
            $table->unsignedInteger('category_id'); // Mismo tipo que categories.id
            $table->foreign('category_id')->references('id')->on('categories');
            $table->dateTime('event_date')->nullable(); // Fecha y hora del evento
            $table->string('location')->nullable(); // Lugar del evento
            $table->string('organizer')->nullable(); // Organizador del evento
            $table->string('image')->nullable(); // Imagen principal
            $table->string('video_url')->nullable(); // URL del video (opcional)
            $table->enum('status', ['draft', 'published'])->default('draft'); // Estado del evento
            $table->enum('type', ['Event', 'Service', 'Gallery', 'Video', 'Banner','Promotion','Package', 'Article', 'Section'])->default('Event'); // Tipo de evento
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes(); // Soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};

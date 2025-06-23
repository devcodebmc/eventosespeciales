<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_tags', function (Blueprint $table) {
            $table->increments('id');
            
            // Cambiar foreignId a unsignedInteger para coincidir con tus otras migraciones
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('tag_id');
            
            // Definir las claves foráneas explícitamente
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
                
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
            
            $table->unique(['event_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_tags');
    }
}

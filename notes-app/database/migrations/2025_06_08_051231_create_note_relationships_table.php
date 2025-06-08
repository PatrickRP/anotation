<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_note_id')->constrained('notes')->onDelete('cascade');
            $table->foreignId('linked_note_id')->constrained('notes')->onDelete('no action');
            $table->timestamps();
            $table->unique(['source_note_id', 'linked_note_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_relationships');
    }
}

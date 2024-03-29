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
        Schema::create('thread_tags_map', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('threads_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_tags_map');
    }
};

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
        Schema::create('blogs', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('blog_name');
            $table->text('blog_description');
            $table->date('blog_date');
            $table->string('status');
            $table->unsignedBigInteger('author_id');
            $table->string('author_name');
            $table->string('slug')->unique();
            $table->string('excerpt', 500);
            $table->string('image_url')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};

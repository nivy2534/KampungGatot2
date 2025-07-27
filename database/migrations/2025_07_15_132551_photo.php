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
        Schema::create('photos', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('photo_name');
            $table->text('photo_description')->nullable();
            $table->date('photo_date')->nullable();
            $table->string('image_path')->nullable(); // kolom untuk nama file gambar
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->timestamps();
            $table->string('kategori')->nullable();
            $table->string('status')->default('draft'); // published | draft | archived
            $table->unsignedBigInteger('author_id')->nullable();
            $table->boolean('is_active')->default(true);

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo');
    }
};

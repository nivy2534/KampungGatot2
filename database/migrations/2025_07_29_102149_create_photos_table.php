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
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo_name');
            $table->text('photo_description')->nullable();
            $table->string('category', 50)->nullable();
            $table->date('photo_date')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('event_id')->nullable()->index('photos_event_id_foreign');
            $table->unsignedBigInteger('product_id')->nullable()->index('photos_product_id_foreign');
            $table->unsignedBigInteger('blog_id')->nullable()->index('photos_blog_id_foreign');
            $table->timestamps();
            $table->string('kategori')->nullable();
            $table->string('status')->default('draft');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};

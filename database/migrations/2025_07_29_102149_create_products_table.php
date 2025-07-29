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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('price', 10);
            $table->string('name');
            $table->string('description');
            $table->string('contact_person');
            $table->string('seller_name');
            $table->enum('status', ['ready', 'habis', 'preorder'])->default('ready');
            $table->unsignedBigInteger('author_id');
            $table->string('author_name');
            $table->string('slug')->unique();
            $table->string('excerpt', 500);
            $table->string('image_url')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

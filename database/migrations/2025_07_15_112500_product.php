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
            $table->engine = 'InnoDB';
            $table->id();

            $table->string('product_name');
            $table->text('product_description')->nullable(); // jika deskripsi bisa panjang
            $table->decimal('product_price', 10, 2);
            $table->string('product_contact_person');

            $table->string('author_name')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_path')->nullable();

            $table->timestamps(); // created_at & updated_at
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

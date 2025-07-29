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
        Schema::table('photos', function (Blueprint $table) {
            $table->foreign(['blog_id'])->references(['id'])->on('blogs')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['event_id'])->references(['id'])->on('events')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign('photos_blog_id_foreign');
            $table->dropForeign('photos_event_id_foreign');
            $table->dropForeign('photos_product_id_foreign');
        });
    }
};

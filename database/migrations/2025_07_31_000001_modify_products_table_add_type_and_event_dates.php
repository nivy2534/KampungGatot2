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
        Schema::table('products', function (Blueprint $table) {
            // Tambah kolom tipe produk
            $table->enum('type', ['produk', 'event'])->default('produk')->after('description');
            
            // Tambah kolom rentang tanggal event
            $table->date('event_start_date')->nullable()->after('type');
            $table->date('event_end_date')->nullable()->after('event_start_date');
            
            // Hapus kolom status
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Kembalikan kolom status
            $table->enum('status', ['ready', 'habis', 'preorder'])->default('ready');
            
            // Hapus kolom yang ditambahkan
            $table->dropColumn(['type', 'event_start_date', 'event_end_date']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use Carbon\Carbon;

return new class extends Migration
{
    public function up()
    {
        // Event yang sudah lewat (kemarin)
        Product::create([
            'name' => 'Pameran Kerajinan Tangan Kampung Gatot',
            'description' => 'Pameran kerajinan tangan tradisional dari warga Kampung Gatot',
            'price' => 0,
            'type' => 'event',
            'event_start_date' => Carbon::yesterday()->format('Y-m-d'),
            'event_end_date' => Carbon::yesterday()->format('Y-m-d'),
            'seller_name' => 'Kelompok Kerajinan Gatot',
            'contact_person' => '628123456789',
            'author_id' => 1,
            'author_name' => 'Admin',
            'slug' => 'pameran-kerajinan-tangan-kampung-gatot',
            'excerpt' => 'Pameran kerajinan tangan tradisional'
        ]);

        // Event yang sedang berlangsung
        Product::create([
            'name' => 'Festival Gatot Basah',
            'description' => 'Festival kuliner gatot basah khas Kampung Gatot dengan berbagai varian rasa',
            'price' => 15000,
            'type' => 'event',
            'event_start_date' => Carbon::today()->format('Y-m-d'),
            'event_end_date' => Carbon::today()->addDays(2)->format('Y-m-d'),
            'seller_name' => 'Kelompok Kuliner Gatot',
            'contact_person' => '628987654321',
            'author_id' => 1,
            'author_name' => 'Admin',
            'slug' => 'festival-gatot-basah',
            'excerpt' => 'Festival kuliner gatot basah khas Kampung Gatot'
        ]);

        // Event yang akan datang
        Product::create([
            'name' => 'Workshop Pertanian Organik',
            'description' => 'Pelatihan teknik pertanian organik untuk meningkatkan hasil panen',
            'price' => 25000,
            'type' => 'event',
            'event_start_date' => Carbon::tomorrow()->addDays(3)->format('Y-m-d'),
            'event_end_date' => Carbon::tomorrow()->addDays(5)->format('Y-m-d'),
            'seller_name' => 'Kelompok Tani Maju',
            'contact_person' => '628555666777',
            'author_id' => 1,
            'author_name' => 'Admin',
            'slug' => 'workshop-pertanian-organik',
            'excerpt' => 'Pelatihan teknik pertanian organik'
        ]);

        // Event gratis yang akan datang
        Product::create([
            'name' => 'Bakti Sosial Kampung Gatot',
            'description' => 'Kegiatan bakti sosial untuk membersihkan lingkungan kampung',
            'price' => 0,
            'type' => 'event',
            'event_start_date' => Carbon::tomorrow()->addWeek()->format('Y-m-d'),
            'event_end_date' => Carbon::tomorrow()->addWeek()->format('Y-m-d'),
            'seller_name' => 'Karang Taruna Gatot',
            'contact_person' => '628111222333',
            'author_id' => 1,
            'author_name' => 'Admin',
            'slug' => 'bakti-sosial-kampung-gatot',
            'excerpt' => 'Kegiatan bakti sosial untuk membersihkan lingkungan'
        ]);
    }

    public function down()
    {
        // Remove sample events
        Product::where('type', 'event')->whereIn('slug', [
            'pameran-kerajinan-tangan-kampung-gatot',
            'festival-gatot-basah',
            'workshop-pertanian-organik',
            'bakti-sosial-kampung-gatot'
        ])->delete();
    }
};

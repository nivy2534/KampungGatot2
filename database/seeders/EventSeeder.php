<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing events to avoid duplicates
        Product::where('type', 'event')->delete();

        $events = [
            [
                'name' => 'Festival Gatot Basah',
                'description' => 'Festival kuliner gatot basah khas Kampung Gatot dengan berbagai varian rasa. Nikmati kelezatan gatot basah dengan berbagai topping menarik dan harga terjangkau.',
                'price' => 15000,
                'type' => 'event',
                'event_start_date' => Carbon::today()->format('Y-m-d'),
                'event_end_date' => Carbon::today()->addDays(2)->format('Y-m-d'),
                'seller_name' => 'Kelompok Kuliner Gatot',
                'contact_person' => '8987654321',
                'author_id' => 1,
                'author_name' => 'Admin',
                'slug' => 'festival-gatot-basah',
                'excerpt' => 'Festival kuliner gatot basah khas Kampung Gatot'
            ],
            [
                'name' => 'Workshop Pertanian Organik',
                'description' => 'Pelatihan teknik pertanian organik untuk meningkatkan hasil panen. Pelajari cara bercocok tanam yang ramah lingkungan dan meningkatkan kualitas hasil panen.',
                'price' => 25000,
                'type' => 'event',
                'event_start_date' => Carbon::today()->addDays(3)->format('Y-m-d'),
                'event_end_date' => Carbon::today()->addDays(5)->format('Y-m-d'),
                'seller_name' => 'Kelompok Tani Maju',
                'contact_person' => '8555666777',
                'author_id' => 1,
                'author_name' => 'Admin',
                'slug' => 'workshop-pertanian-organik',
                'excerpt' => 'Pelatihan teknik pertanian organik'
            ],
            [
                'name' => 'Pameran Kerajinan Kampung Gatot',
                'description' => 'Pameran kerajinan tangan tradisional dari warga Kampung Gatot. Temukan berbagai karya seni dan kerajinan unik buatan tangan warga lokal.',
                'price' => 0,
                'type' => 'event',
                'event_start_date' => Carbon::yesterday()->format('Y-m-d'),
                'event_end_date' => Carbon::yesterday()->format('Y-m-d'),
                'seller_name' => 'Kelompok Kerajinan Gatot',
                'contact_person' => '8123456789',
                'author_id' => 1,
                'author_name' => 'Admin',
                'slug' => 'pameran-kerajinan-kampung-gatot',
                'excerpt' => 'Pameran kerajinan tangan tradisional'
            ],
            [
                'name' => 'Bakti Sosial Kampung Gatot',
                'description' => 'Kegiatan bakti sosial untuk membersihkan lingkungan kampung dan menanam pohon. Mari bergotong royong untuk menjaga kebersihan lingkungan.',
                'price' => 0,
                'type' => 'event',
                'event_start_date' => Carbon::today()->addWeek()->format('Y-m-d'),
                'event_end_date' => Carbon::today()->addWeek()->format('Y-m-d'),
                'seller_name' => 'Karang Taruna Gatot',
                'contact_person' => '8111222333',
                'author_id' => 1,
                'author_name' => 'Admin',
                'slug' => 'bakti-sosial-kampung-gatot',
                'excerpt' => 'Kegiatan bakti sosial untuk membersihkan lingkungan'
            ],
            [
                'name' => 'Pelatihan Digital Marketing UMKM',
                'description' => 'Pelatihan digital marketing untuk pelaku UMKM Kampung Gatot. Pelajari cara memasarkan produk secara online dan meningkatkan penjualan.',
                'price' => 50000,
                'type' => 'event',
                'event_start_date' => Carbon::today()->addDays(10)->format('Y-m-d'),
                'event_end_date' => Carbon::today()->addDays(12)->format('Y-m-d'),
                'seller_name' => 'Tim Digital Kampung Gatot',
                'contact_person' => '8999888777',
                'author_id' => 1,
                'author_name' => 'Admin',
                'slug' => 'pelatihan-digital-marketing-umkm',
                'excerpt' => 'Pelatihan digital marketing untuk pelaku UMKM'
            ]
        ];

        foreach ($events as $eventData) {
            Product::create($eventData);
        }
    }
}

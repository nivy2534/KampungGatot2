<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Photo;
use Carbon\Carbon;

class RecentActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some recent blogs
        Blog::create([
            'name' => 'Panen Raya Padi di Desa Ngebruk',
            'slug' => 'panen-raya-padi-di-desa-ngebruk',
            'description' => 'Desa Ngebruk mengalami panen raya padi dengan hasil yang melimpah.',
            'excerpt' => 'Panen raya padi dengan hasil melimpah di Desa Ngebruk',
            'status' => 'published',
            'author_id' => 1,
            'author_name' => 'Admin',
            'tag' => 'pertanian',
            'created_at' => Carbon::now()->subHours(2),
            'updated_at' => Carbon::now()->subHours(2)
        ]);

        Blog::create([
            'name' => 'Program Bantuan Bibit Tanaman',
            'slug' => 'program-bantuan-bibit-tanaman',
            'description' => 'Pemerintah desa memberikan bantuan bibit tanaman untuk warga.',
            'excerpt' => 'Program bantuan bibit tanaman dari pemerintah desa',
            'status' => 'published',
            'author_id' => 1,
            'author_name' => 'Admin',
            'tag' => 'sosial',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1)
        ]);

        // Create some recent products
        Product::create([
            'name' => 'Kerajinan Anyaman Bambu',
            'description' => 'Kerajinan anyaman bambu hasil karya warga desa',
            'excerpt' => 'Kerajinan anyaman bambu berkualitas tinggi',
            'price' => '50000',
            'contact_person' => '081234567890',
            'seller_name' => 'Ibu Siti',
            'type' => 'produk',
            'author_id' => 1,
            'author_name' => 'Admin',
            'slug' => 'kerajinan-anyaman-bambu',
            'created_at' => Carbon::now()->subHours(6),
            'updated_at' => Carbon::now()->subHours(6)
        ]);

        Product::create([
            'name' => 'Workshop Membatik Tradisional',
            'description' => 'Workshop belajar membatik dengan teknik tradisional untuk umum',
            'excerpt' => 'Belajar membatik dengan pengrajin berpengalaman',
            'price' => '100000',
            'contact_person' => '081234567891',
            'seller_name' => 'Sanggar Batik Ngebruk',
            'type' => 'event',
            'event_start_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'event_end_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'author_id' => 1,
            'author_name' => 'Admin',
            'slug' => 'workshop-membatik-tradisional',
            'created_at' => Carbon::now()->subDays(2),
            'updated_at' => Carbon::now()->subDays(2)
        ]);

        // Create some recent photos
        Photo::create([
            'photo_name' => 'Suasana Panen Padi',
            'photo_description' => 'Dokumentasi kegiatan panen padi di sawah desa',
            'category' => 'pertanian',
            'photo_date' => Carbon::today(),
            'status' => 'published',
            'author_id' => 1,
            'is_active' => true,
            'created_at' => Carbon::now()->subHours(4),
            'updated_at' => Carbon::now()->subHours(4)
        ]);

        Photo::create([
            'photo_name' => 'Gotong Royong Pembersihan Desa',
            'photo_description' => 'Kegiatan gotong royong membersihkan lingkungan desa',
            'category' => 'sosial',
            'photo_date' => Carbon::yesterday(),
            'status' => 'published',
            'author_id' => 1,
            'is_active' => true,
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now()->subDays(3)
        ]);
    }
}

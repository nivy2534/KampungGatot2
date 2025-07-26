<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user
        $user = User::firstOrCreate([
            'email' => 'admin@kampungngebruk.com'
        ], [
            'name' => 'Admin Kampung Ngebruk',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);

        // Sample blogs
        $blogs = [
            [
                'name' => 'Sejarah Kampung Ngebruk yang Harus Kamu Tahu',
                'description' => 'Kampung Ngebruk memiliki sejarah panjang yang dimulai dari era kolonial. Desa ini didirikan oleh para petani yang mencari lahan subur untuk bertani. Seiring berjalannya waktu, kampung ini berkembang menjadi salah satu desa yang memiliki potensi wisata dan ekonomi yang menjanjikan.',
                'status' => 'published',
                'tag' => 'sejarah',
                'image_url' => '/assets/img/blogthumb.png',
            ],
            [
                'name' => 'Potensi Wisata Alam di Kampung Ngebruk',
                'description' => 'Kampung Ngebruk menyimpan berbagai potensi wisata alam yang menakjubkan. Mulai dari persawahan hijau yang asri, sungai jernih yang mengalir, hingga pemandangan gunung yang memukau. Semua ini menjadi daya tarik tersendiri bagi wisatawan yang ingin menikmati keindahan alam pedesaan.',
                'status' => 'published',
                'tag' => 'potensi_desa',
                'image_url' => '/assets/img/blogthumb.png',
            ],
            [
                'name' => 'Gotong Royong Membangun Jalan Desa',
                'description' => 'Warga Kampung Ngebruk kembali menunjukkan semangat gotong royong dalam pembangunan infrastruktur desa. Dengan bergotong royong, mereka berhasil memperbaiki jalan desa yang rusak akibat hujan deras beberapa waktu lalu. Kegiatan ini melibatkan seluruh lapisan masyarakat.',
                'status' => 'published',
                'tag' => 'kabar_warga',
                'image_url' => '/assets/img/blogthumb.png',
            ],
            [
                'name' => 'Festival UMKM Kampung Ngebruk 2025',
                'description' => 'Kampung Ngebruk akan mengadakan Festival UMKM untuk memperkenalkan berbagai produk unggulan dari warga setempat. Festival ini diharapkan dapat meningkatkan ekonomi masyarakat dan memperkenalkan potensi UMKM kepada masyarakat luas.',
                'status' => 'published',
                'tag' => 'umkm_lokal',
                'image_url' => '/assets/img/blogthumb.png',
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::firstOrCreate([
                'slug' => Str::slug($blogData['name'])
            ], [
                'name' => $blogData['name'],
                'description' => $blogData['description'],
                'status' => $blogData['status'],
                'author_id' => $user->id,
                'author_name' => $user->name,
                'slug' => Str::slug($blogData['name']),
                'excerpt' => Str::limit($blogData['description'], 200),
                'image_url' => $blogData['image_url'],
                'tag' => $blogData['tag'],
            ]);
        }

        // Sample products
        $products = [
            [
                'name' => 'Beras Organik Kampung Ngebruk',
                'price' => 25000,
                'description' => 'Beras organik berkualitas tinggi yang ditanam secara tradisional tanpa menggunakan pestisida. Memiliki rasa yang pulen dan aroma yang wangi. Cocok untuk keluarga yang menginginkan makanan sehat dan bergizi.',
                'status' => 'ready',
                'seller_name' => 'Pak Slamet',
                'contact_person' => '081234567890',
                'image_url' => '/assets/img/belanja.png',
            ],
            [
                'name' => 'Kerupuk Ikan Tradisional',
                'price' => 15000,
                'description' => 'Kerupuk ikan buatan rumahan dengan cita rasa tradisional yang gurih dan renyah. Dibuat dari ikan segar pilihan dan bumbu rempah alami. Cocok sebagai cemilan atau pelengkap makan.',
                'status' => 'ready',
                'seller_name' => 'Ibu Sari',
                'contact_person' => '082345678901',
                'image_url' => '/assets/img/belanja.png',
            ],
            [
                'name' => 'Madu Hutan Asli',
                'price' => 75000,
                'description' => 'Madu murni dari hutan sekitar Kampung Ngebruk yang diambil secara tradisional. Memiliki khasiat yang baik untuk kesehatan dan rasa yang manis alami. Dikemas dalam botol kaca yang aman dan higienis.',
                'status' => 'ready',
                'seller_name' => 'Pak Budi',
                'contact_person' => '083456789012',
                'image_url' => '/assets/img/belanja.png',
            ],
            [
                'name' => 'Tempe Kedelai Organik',
                'price' => 8000,
                'description' => 'Tempe segar yang dibuat dari kedelai organik pilihan dengan proses fermentasi alami. Kaya akan protein dan cocok untuk menu makanan sehat keluarga. Tersedia setiap hari dengan kualitas terjamin.',
                'status' => 'ready',
                'seller_name' => 'Ibu Wati',
                'contact_person' => '084567890123',
                'image_url' => '/assets/img/belanja.png',
            ],
            [
                'name' => 'Sayuran Hidroponik Segar',
                'price' => 12000,
                'description' => 'Paket sayuran hidroponik segar meliputi selada, kangkung, dan bayam. Ditanam dengan sistem hidroponik modern sehingga bebas dari pestisida dan selalu segar. Cocok untuk salad atau menu masakan sehat.',
                'status' => 'ready',
                'seller_name' => 'Pak Joko',
                'contact_person' => '085678901234',
                'image_url' => '/assets/img/belanja.png',
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate([
                'slug' => Str::slug($productData['name'])
            ], [
                'name' => $productData['name'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'status' => $productData['status'],
                'author_id' => $user->id,
                'author_name' => $user->name,
                'seller_name' => $productData['seller_name'],
                'contact_person' => $productData['contact_person'],
                'slug' => Str::slug($productData['name']),
                'excerpt' => Str::limit($productData['description'], 200),
                'image_url' => $productData['image_url'],
            ]);
        }
    }
}

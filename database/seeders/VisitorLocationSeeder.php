<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing sample data
        Visitor::where('user_agent', 'like', '%Sample%')->delete();

        $cities = [
            ['city' => 'Malang', 'province' => 'Jawa Timur', 'count' => 25], // Highest
            ['city' => 'Jakarta', 'province' => 'DKI Jakarta', 'count' => 20],
            ['city' => 'Surabaya', 'province' => 'Jawa Timur', 'count' => 18],
            ['city' => 'Bandung', 'province' => 'Jawa Barat', 'count' => 15],
            ['city' => 'Semarang', 'province' => 'Jawa Tengah', 'count' => 12],
            ['city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'count' => 10],
            ['city' => 'Denpasar', 'province' => 'Bali', 'count' => 8],
            ['city' => 'Medan', 'province' => 'Sumatera Utara', 'count' => 6],
            ['city' => 'Makassar', 'province' => 'Sulawesi Selatan', 'count' => 5],
            ['city' => 'Balikpapan', 'province' => 'Kalimantan Timur', 'count' => 4]
        ];

        foreach ($cities as $location) {
            for ($i = 0; $i < $location['count']; $i++) {
                Visitor::create([
                    'ip_address' => '203.89.146.' . rand(1, 254),
                    'user_agent' => 'Sample Browser Data',
                    'url' => 'https://kampunggatot.com',
                    'city' => $location['city'],
                    'province' => $location['province'],
                    'created_at' => Carbon::now()->subDays(rand(0, 29)),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}

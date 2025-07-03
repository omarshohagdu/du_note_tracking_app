<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('districts')->truncate();
        DB::table('divisions')->truncate();


        $divisionsWithDistricts = [
            'Dhaka' => [
                'Dhaka', 'Faridpur', 'Gazipur', 'Gopalganj', 'Kishoreganj', 'Madaripur',
                'Manikganj', 'Munshiganj', 'Narayanganj', 'Narsingdi', 'Rajbari',
                'Shariatpur', 'Tangail'
            ],
            'Chattogram' => [
                'Bandarban', 'Brahmanbaria', 'Chandpur', 'Chattogram', 'Cumilla',
                'Cox\'s Bazar', 'Feni', 'Khagrachari', 'Lakshmipur', 'Noakhali',
                'Rangamati'
            ],
            'Rajshahi' => [
                'Bogura', 'Joypurhat', 'Naogaon', 'Natore', 'Chapainawabganj',
                'Pabna', 'Rajshahi', 'Sirajganj'
            ],
            'Khulna' => [
                'Bagerhat', 'Chuadanga', 'Jashore', 'Jhenaidah', 'Khulna',
                'Kushtia', 'Magura', 'Meherpur', 'Narail', 'Satkhira'
            ],
            'Barisal' => [
                'Barguna', 'Barisal', 'Bhola', 'Jhalokathi', 'Patuakhali', 'Pirojpur'
            ],
            'Sylhet' => [
                'Habiganj', 'Moulvibazar', 'Sunamganj', 'Sylhet'
            ],
            'Rangpur' => [
                'Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari',
                'Panchagarh', 'Rangpur', 'Thakurgaon'
            ],
            'Mymensingh' => [
                'Jamalpur', 'Mymensingh', 'Netrokona', 'Sherpur'
            ],
        ];

        foreach ($divisionsWithDistricts as $divisionName => $districts) {
            $divisionId = DB::table('divisions')->insertGetId([
                'name' => $divisionName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($districts as $district) {
                DB::table('districts')->insert([
                    'name' => $district,
                    'division_id' => $divisionId,
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

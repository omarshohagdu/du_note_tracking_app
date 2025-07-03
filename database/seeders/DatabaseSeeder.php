<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AllSetting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DistrictSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Omar Shohag',
            'email' => 'omarshohag93@gmail.com',
        ]);


//        $this->call([
//            DistrictSeeder::class,
//        ]);
//
//        $settingsData = [
//            // 1 = Religion
//            1 => ['Islam', 'Hindus', 'Buddhists', 'Christianity', 'Other Religions'],
//
//            // 2 = Occupation
//            2 => [
//                'Housewife', 'Farmer', 'Day Labour', 'Business', 'Student',
//                'Govt. Service', 'Private Service', 'Others',
//                'Garments Worker', 'Journalist'
//            ],
//
//            // 3 = Education Status
//            3 => [
//                'Primary', 'Secondary', 'SSC', 'HSC',
//                'Graduate', 'Illiterate', 'Post graduate', 'Masters'
//            ],
//
//            // 4 = Monthly Income
//            4 => ['<< 5000', '<< 7000', '<< 10000', '<< 15000', '<< 20000', '>> 20000'],
//
//            // 5 = Blood Group
//            5 => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
//
//            // diagnosis
//            6 => ['Lower Abdominal Pain', 'Whole Abdominal Pain', 'Test Infos', 'Test Infos 2'],
//
//            // C/F
//            7 => ['Pain ', 'Body Pain', 'Whole Pain'],
//
//            // Name of Operation
//            8 => ['Major Operation', 'Minor Operation', 'Gastric Operation', 'Other Operation'],
//
//             // Doctor Designation
//            9 => ['Professor', 'Association Professor', 'Assistant Professor', 'Senior Consultant',  'Consultant', 'Doctor', 'Other']
//        ];
//
//        // Build and insert settings
//        foreach ($settingsData as $type => $titles) {
//            foreach ($titles as $index => $title) {
//                AllSetting::create([
//                    'title'         => $title,
//                    'type'          => $type,
//                    'display_order' => $index + 1,
//                    'is_active'     => 1
//                ]);
//            }
//        }
    }
}

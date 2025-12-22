<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run()
    {
        $types   = ['full-time', 'part-time', 'contract'];
        $genders = ['male', 'female', 'both', 'other'];
        $applies = ['url', 'email', 'in-person', 'address'];

        for ($i = 1; $i <= 20; $i++) {

            Job::create([
                'title'        => "Demo Job Post {$i}",
                'slug'         => Str::slug("Demo Job Post {$i}") . "-{$i}",
                'apply_value'  => 'Online',
                'salary'       => 'Negotiable',
                'vacancy'      => rand(1, 10),
                'company'      => "Demo Company {$i}",
                'educational'  => 'Bachelor Degree',
                'experience'   => '1-2 Years',
                'additional'   => 'This is fake job data',

                // ✅ ENUM — ONE VALID VALUE AT A TIME
                'type'         => $types[array_rand($types)],
                'gender'       => $genders[array_rand($genders)],
                'apply'        => $applies[array_rand($applies)],

                'category_id'  => rand(1, 2),
                'user_id'      => 1,
                'location'     => 'Dhaka',
                'source_link'  => 'https://example.com',
                'description'  => 'This is demo job description',
                'views'        => rand(0, 500),

                // fake numeric (string is OK)
                'thumb'        => (string) rand(1, 10),
                'attachment'   => (string) rand(1, 10),
            ]);
        }
    }
}
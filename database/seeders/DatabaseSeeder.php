<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CentrePoint;
use App\Models\Space;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        CentrePoint::create([
            'location' => '-7.255118363525826, 112.74929180153393',
        ]);

        Space::create([
            'name' => 'Mie Gacoan',
            'slug' => 'gacoan',
            'image' => 'gacoan_ambengan.jpg',
            'street' => 'Jl. Ambengan',
            'location' => '-7.255118363525826, 112.74929180153393',
            'content' => 'Mie Gacoan viral wow',

        ]);
    }
}

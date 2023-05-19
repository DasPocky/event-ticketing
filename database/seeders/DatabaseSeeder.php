<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Dennis Schwerdt',
            'email' => 'ds@s-vtec.de',
            'password' => bcrypt('ChangeMe2023#'),
        ]);
        $user->organizer()->create([
            'user_id' => $user->id,
            'name' => 'Schwerdt Veranstaltungstechnik',
            'address' => 'Tulpenweg 6',
            'zip' => '41517',
            'city' => 'Grevenbroich',
            'country' => 'Deutschland',
            'email' => 'info@s-vtec.de',
            'phone' => '+49 2181 819 99 99',
            'website' => 'https://www.s-vtec.de',
        ]);
    }
}

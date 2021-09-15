<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory()->create([
            'email' => 'user@example.com',
        ]);

        Company::factory()->create();
        // \App\Models\User::factory(100)->create();
    }
}

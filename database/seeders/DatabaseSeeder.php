<?php

namespace Database\Seeders;

use App\Http\Controllers\ProjectController;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::factory()->create([
            'name' => 'GP user',
            'email' => 'gp@example.com',
        ]);
         User::factory(5)->create();

        $this->call([
            ProjectSeeder::class,
            TaskSeeder::class,
            RoleSeeder::class,
        ]);
    }
}

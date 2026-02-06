<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Role::factory()->count(3)->create();
        $roleArray = ['admin', 'viewer', 'project_manager'];
        foreach ($roleArray as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        $users = User::all();
        foreach ($users as $user) {
            if ($user->id == 1) {
                $user->roles()->sync([1]);
            } else {
                $user->roles()->sync(Role::inRandomOrder()->pluck("id")->first());
            }

        }
    }
}

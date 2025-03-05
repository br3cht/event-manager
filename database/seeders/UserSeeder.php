<?php

namespace Database\Seeders;

use App\Enum\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::count() != 0) {
            return;
        }

        $user = User::factory()->create();
        $user->assignRole(RoleEnum::Admin->value);

        $user = User::factory()->create();
        $user->assignRole(RoleEnum::User->value);
    }
}

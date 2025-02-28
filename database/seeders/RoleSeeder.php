<?php

namespace Database\Seeders;

use App\Enum\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Role::count() != 0){
            return;
        }

        Role::create(['name' => RoleEnum::Admin->value]);
        Role::create(['name' => RoleEnum::User->value]);
    }
}

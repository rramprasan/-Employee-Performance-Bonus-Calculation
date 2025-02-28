<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(AdminUserSeeder::class);
       $this->call(RoleSeeder::class);


        $admin = User::where('email', 'admin@admin.com')->first();
    if ($admin) {
        $admin->assignRole('admin');
    }
    }
}

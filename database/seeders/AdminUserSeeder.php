<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::create([
            'name'      => 'CenBa Admin',
            'email'     => 'cenbaawards@gmail.com',
            'password'  => 'Cenba@2026',
            'role'      => 'super_admin',
            'is_active' => true,
        ]);
    }
}
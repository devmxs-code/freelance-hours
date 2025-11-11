<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@admin.com'],
            [
                'name' => 'Administrador',
                'email' => 'user@admin.com',
                'password' => Hash::make('admin'),
                'is_admin' => true,
                'bio' => 'Usuário administrador do sistema',
                'company' => 'Freelance Hours',
            ]
        );
    }
}

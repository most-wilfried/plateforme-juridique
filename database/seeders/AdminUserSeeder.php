<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@plateforme-juridique.test',
        ], [
            'name' => 'Administrateur',
            'role' => 'admin',
            'password' => Hash::make('Password123!'),
            'is_approved' => true,
            'approved_at' => now(),
        ]);
    }
}

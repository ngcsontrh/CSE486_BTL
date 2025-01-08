<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();
        DB::statement(
            'EXEC sp_create_user
            @username = ?,
            @password = ?,
            @email = ?,
            @name = ?,
            @phone_number = ?,
            @address = ?,
            @role = ?', [
            'admin',
            Hash::make('admin123'),
            'admin@gmail.com',
            'Admin',
            null,
            null,
            'admin'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Admin::create([
            'user_name' => 'admin123',
            'password_hash' => \Illuminate\Support\Facades\Hash::make('admin123')
        ]);

        $this->call([
            FaqSeeder::class,
        ]);
    }
}

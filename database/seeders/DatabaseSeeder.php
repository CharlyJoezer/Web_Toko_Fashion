<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\Administrator::create([
            'username' => 'charly',
            'password' => Hash::make('12345'),
        ]);

        \App\Models\Category_product::insert([
            [
                'name_category' => 'Baju',
                'icon_category' => 'null'
            ],
            [
                'name_category' => 'Celana',
                'icon_category' => 'null'
            ],
            [
                'name_category' => 'Sepatu',
                'icon_category' => 'null'
            ],
        ]);
    }
}

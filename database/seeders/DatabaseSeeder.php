<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            ['nome' => 'Mouse','preco' => '50.00'],
            ['nome' => 'Teclado','preco' => '80.00'],
            ['nome' => 'Monitor','preco' => '90.00'],
            ['nome' => 'HD','preco' => '150.00'],
            ['nome' => 'SSD','preco' => '200.00'],
            ['nome' => 'RAM','preco' => '250.00'],
        ];

        Produto::insert($data);
    }
}

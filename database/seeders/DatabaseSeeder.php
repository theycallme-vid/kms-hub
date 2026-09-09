<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\BarangSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PegawaiSeeder::class,
            KategoriSeeder::class,
            InformasiSeeder::class,
            BarangSeeder::class,
            PelangganSeeder::class,
            NotaSeeder::class,
            DetailNotaSeeder::class
        ]);
    }
}


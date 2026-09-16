<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $dataku = [
            ['nama' => 'Administrator', 'telp' => '-',              'jabatan' => 'Admin',   'email' => 'admin@kms.com', 'password' => '1234567890', 'role' => 'admin'],
            ['nama' => 'Budi Santoso',  'telp' => '081234567890', 'jabatan' => 'Kasir',   'email' => 'budi@kms.com',  'password' => '123',   'role' => 'user'],
            ['nama' => 'Siti Aminah',   'telp' => '081234567891', 'jabatan' => 'Pelayan', 'email' => 'siti@kms.com',  'password' => '123',        'role' => 'user'],
            ['nama' => 'Andi Darmawan', 'telp' => '081234567892', 'jabatan' => 'Manajer', 'email' => 'andi@kms.com',  'password' => '123',        'role' => 'admin'],
            ['nama' => 'Rina Melati',   'telp' => '081234567893', 'jabatan' => 'Kasir',   'email' => 'rina@kms.com',  'password' => '123',        'role' => 'user'],
            ['nama' => 'Joko Susilo',   'telp' => '081234567894', 'jabatan' => 'Koki',    'email' => 'joko@kms.com',  'password' => '123',        'role' => 'user'],
        ];
        DB::table('pegawais')->insert($dataku);
    }
}

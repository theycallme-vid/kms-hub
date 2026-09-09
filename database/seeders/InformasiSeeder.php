<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataku = [
            [
                'kategori_id' => 1, // Makanan Berat
                'judul'       => 'Standar Porsi dan Penyajian Nasi Goreng Spesial',
                'ringkasan'   => 'Panduan operasional dapur untuk menakar porsi dan teknik memasak nasi goreng.',
                'isi'         => 'Gunakan nasi dingin bertekstur pulen sedang seberat 200 gram. Tumis bumbu dasar merah dengan api besar selama 45 detik, masukkan telur orak-arik dan potongan ayam, lalu aduk cepat bersama kecap manis premium hingga harum karamelisasi tercapai.',
                'sumber'      => 'SOP Dapur Utama KMS Hub',
                'status'      => 'publised',
            ],
            [
                'kategori_id' => 1, // Makanan Berat
                'judul'       => 'Prosedur Higienitas Dapur & Keamanan Pangan Daging',
                'ringkasan'   => 'Langkah-langkah pencairan dan penyimpanan daging mentah agar tidak terkontaminasi bakteri.',
                'isi'         => 'Daging beku harus dicairkan di chiller bersuhu 4°C selama minimal 8 jam sebelum diolah. Dilarang mencairkan daging menggunakan air panas langsung karena memicu perkembangan bakteri salmonella.',
                'sumber'      => 'Pedoman Sanitasi & Keamanan Pangan',
                'status'      => 'draft',
            ],
            [
                'kategori_id' => 2, // Makanan Ringan
                'judul'       => 'Teknik Penggorengan Kentang Renyah Maksimal',
                'ringkasan'   => 'Metode double-fry untuk menjaga kerenyahan kentang goreng hingga 45 menit.',
                'isi'         => 'Goreng kentang tahap pertama pada suhu minyak 130°C selama 4 menit, tiriskan dan dinginkan. Lakukan penggorengan kedua pada suhu 180°C selama 2 menit sesaat sebelum disajikan kepada pelanggan.',
                'sumber'      => 'Modul Pelatihan Barista & Snack',
                'status'      => 'publised',
            ],
            [
                'kategori_id' => 3, // Jus
                'judul'       => 'Rasio Komposisi Jus Buah Segar Tanpa Pengawet',
                'ringkasan'   => 'Standar pembuatan jus buah alpukat, mangga, dan buah naga.',
                'isi'         => 'Gunakan 150 gram buah segar beku, 30 ml gula cair murni, 50 ml air matang, dan es batu secukupnya. Blender dengan kecepatan tinggi selama 20 detik untuk menghasilkan tekstur kental dan lembut tanpa merusak vitamin buah.',
                'sumber'      => 'Buku Resep Minuman Segar',
                'status'      => 'publised',
            ],
            [
                'kategori_id' => 6, // Kopi
                'judul'       => 'Kalibrasi Mesin Espresso & Profil Gilingan Biji Kopi',
                'ringkasan'   => 'Pedoman harian barista dalam menentukan grind size dan yield espresso.',
                'isi'         => 'Lakukan kalibrasi setiap pergantian shift pagi dan sore. Dosis bubuk kopi adalah 18 gram untuk menghasilkan yield espresso 36 ml dalam waktu ekstraksi ideal antara 25 hingga 28 detik pada tekanan 9 bar.',
                'sumber'      => 'Manual Operasional Mesin Espresso',
                'status'      => 'publised',
            ],
            [
                'kategori_id' => 6, // Kopi
                'judul'       => 'SOP Penyimpanan Biji Kopi Sangrai (Roasted Beans)',
                'ringkasan'   => 'Menjaga kesegaran dan aroma biji kopi agar tidak cepat apek.',
                'isi'         => 'Simpan biji kopi di dalam wadah kedap udara one-way valve, jauhkan dari paparan sinar matahari langsung dan kelembapan tinggi. Gunakan biji kopi pada fase terbaiknya, yaitu hari ke-7 hingga ke-30 setelah tanggal sangrai (roast date).',
                'sumber'      => 'Panduan Gudang Biji Kopi',
                'status'      => 'draft',
            ],
            [
                'kategori_id' => 7, // Teh
                'judul'       => 'Temperatur dan Waktu Seduh Ideal Daun Teh Hijau',
                'ringkasan'   => 'Cara menyeduh green tea agar tidak terasa pahit berlebihan.',
                'isi'         => 'Gunakan air panas bersuhu 75°C - 80°C. Jangan menyeduh dengan air mendidih (100°C) karena akan membakar daun teh dan melepaskan tanin berlebih yang menyebabkan rasa pahit getir. Waktu seduh maksimal 2 menit.',
                'sumber'      => 'Katalog Produk Teh Herbal',
                'status'      => 'publised',
            ],
        ];

        DB::table('informasi')->insert($dataku);
    }
}

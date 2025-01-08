<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apotek;
use Illuminate\Support\Facades\File;

class ApotekSeeder extends Seeder
{
    public function run()
    {
        // Path file JSON
        $jsonPath = storage_path('app/Apotek.json');

        // Periksa apakah file ada
        if (!File::exists($jsonPath)) {
            $this->command->error("File Apotek.json tidak ditemukan di {$jsonPath}");
            return;
        }

        // Baca file JSON
        $json = File::get($jsonPath);
        $data = json_decode($json, true);

        // Periksa apakah JSON valid
        if ($data === null) {
            $this->command->error("Gagal decode JSON, periksa formatnya.");
            return;
        }

        // Jika hanya satu objek (data tunggal)
        if (isset($data['nama'])) {
            $this->insertApotek($data);
        } else {
            // Jika data berupa array (banyak apotek)
            foreach ($data as $item) {
                $this->insertApotek($item);
            }
        }

        $this->command->info('Data apotek berhasil dimasukkan ke database.');
    }

    // Fungsi untuk memasukkan data apotek dengan validasi
    private function insertApotek($item)
    {
        Apotek::create([
            'nama' => $item['nama'] ?? 'Tidak ada nama',
            'alamat' => $item['alamat'] ?? 'Alamat tidak tersedia',
            'kecamatan' => $item['kecamatan'] ?? 'Tidak ada kecamatan',
            'waktu_operasional' => $item['waktu_operasional'] ?? 'Tidak tersedia',
            'no_telp' => isset($item['no_telp']) && !empty($item['no_telp'])
                ? $item['no_telp']
                : '-',  // Default untuk no_telp kosong
            'longitude' => $item['longitude'] ?? 0,  // Default longitude
            'latitude' => $item['latitude'] ?? 0,    // Default latitude
            'foto' => $item['foto'] ?? null,
        ]);
    }
}

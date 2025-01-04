<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index()
    {
        // Menentukan path file JSON
        $filePath = storage_path('app/apoteks.json');
        
        // Cek apakah file ada
        if (!file_exists($filePath)) {
            return response()->json([
                'error' => 'File apoteks.json tidak ditemukan'
            ], 404);
        }

        // Membaca isi file JSON dan mengonversinya menjadi array PHP
        $apoteks = json_decode(file_get_contents($filePath), true);

        // Cek apakah parsing JSON berhasil
        if ($apoteks === null) {
            return response()->json([
                'error' => 'Gagal membaca data JSON'
            ], 500);
        }

        // Menambahkan path gambar di setiap data apotek
        foreach ($apoteks as &$apotek) {
            // Menentukan format gambar yang tersedia
            $imageFormats = ['jpg', 'jpeg', 'png'];
            $imagePath = '';
        
            foreach ($imageFormats as $format) {
                $filePath = public_path('apotek/' . $apotek['foto'] . '.' . $format);
                if (file_exists($filePath)) {
                    $imagePath = asset('apotek/' . $apotek['foto'] . '.' . $format); // Mengonfigurasi URL gambar
                    break; // Keluar dari loop jika gambar ditemukan
                }
            }
        
            // Jika gambar ditemukan, masukkan URL gambar ke dalam data apotek
            $apotek['foto'] = $imagePath ? $imagePath : asset('apotek/default.jpg'); // Menggunakan gambar default jika tidak ada gambar
        }

        // Mengembalikan data sebagai response JSON
        return response()->json($apoteks);
    }
}

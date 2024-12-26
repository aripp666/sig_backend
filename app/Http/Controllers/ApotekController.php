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

    // Mengembalikan data sebagai response JSON
    return response()->json($apoteks);
}

}

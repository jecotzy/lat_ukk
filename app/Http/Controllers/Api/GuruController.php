<?php

// Deklarasi namespace controller
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Method untuk menampilkan semua data guru
    public function index()
    {
        // Mengembalikan semua data guru dalam bentuk JSON
        return Guru::all();
    }

    // Method untuk menyimpan data guru baru
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:guru,nip', // nip harus unik
            'gender' => 'required|in:L,P', // hanya boleh L (Laki-laki) atau P (Perempuan)
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20', // kontak tidak wajib
            'email' => 'nullable|email|unique:guru,email', // email harus unik jika diisi
        ]);

        // Simpan data ke dalam database
        $guru = Guru::create($request->all());

        // Kembalikan response berhasil
        return response()->json([
            'message' => 'Guru berhasil dibuat',
            'data' => $guru
        ], 201); // 201 = Created
    }

    // Method untuk menampilkan detail satu guru berdasarkan ID
    public function show($id)
    {
        $guru = Guru::find($id);

        // Jika guru tidak ditemukan
        if (!$guru) {
            return response()->json(['message' => 'Guru tidak ditemukan'], 404);
        }

        // Kembalikan data guru
        return response()->json($guru);
    }

    // Method untuk memperbarui data guru berdasarkan ID
    public function update(Request $request, string $id)
    {
        try {
            // Cari guru berdasarkan ID
            $siswa = Guru::findOrFail($id);

            // Validasi data input, gunakan `sometimes` agar hanya field yang dikirim yang divalidasi
            $validated = $request->validate([
                'nama'       => 'sometimes|required|string|max:255',
                'nip'        => 'sometimes|required|string|max:255|unique:guru,nip,' . $id,
                'gender'     => 'sometimes|required|in:L,P',
                'alamat'     => 'sometimes|required|string',
                'kontak'     => 'sometimes|required|string|max:255',
                'email'      => 'sometimes|required|email|unique:guru,email,' . $id,
            ]);

            // Update data guru
            $siswa->fill($validated)->save();

            // Kembalikan data yang sudah diupdate
            return response()->json($siswa);

        } catch (\Exception $e) {
            // Tangani jika terjadi error server atau data tidak ditemukan
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Method untuk menghapus data guru
    public function destroy(Guru $guru)
    {
        // Hapus guru dari database
        $guru->delete();

        // Kembalikan response kosong dengan status 204 (No Content)
        return response()->json(null, 204);
    }
}

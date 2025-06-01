<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan seluruh data siswa
    public function index()
    {
        return Siswa::all();
        // Mengembalikan semua data siswa dalam format JSON
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        // Validasi data yang masuk dari client
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|unique:siswas,nis',              // Harus unik
            'gender' => 'required|in:L,P',                     // Hanya boleh L atau P
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email',  // Harus unik dan format email valid
            'foto' => 'nullable|string|max:255',              // Opsional
            'status_lapor_pkl' => 'required|in:yes,no',       // Status hanya yes atau no
        ]);

        // Simpan ke database dan kembalikan response JSON
        return response()->json(Siswa::create($validated), 201); // 201 = Created
    }

    // Menampilkan data siswa berdasarkan ID
    public function show($id)
    {
        $siswa = Siswa::find($id);

        // Jika siswa tidak ditemukan
        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        // Jika ditemukan, kembalikan datanya
        return response()->json($siswa);
    }

    // Memperbarui data siswa
    public function update(Request $request, $id)
    {
        try {
            // Cari siswa berdasarkan ID, gagal = throw 404
            $siswa = Siswa::findOrFail($id);

            // Validasi request
            $validated = $request->validate([
                'nama' => 'sometimes|required|string|max:255',
                'nis' => 'sometimes|required|string|max:255|unique:siswas,nis,' . $id, // Unique kecuali dirinya sendiri
                'gender' => 'sometimes|required|in:L,P',
                'alamat' => 'sometimes|required|string',
                'kontak' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:siswas,email,' . $id,
                'foto' => 'nullable|string|max:255',
                'status_lapor_pkl' => 'sometimes|required|in:yes,no',
            ]);

            // Update data siswa
            $siswa->fill($validated)->save();

            // Kembalikan data siswa yang telah diperbarui
            return response()->json($siswa);
        } catch (\Exception $e) {
            // Tangani error dan kembalikan response error server
            return response()->json([
                'error' => 'Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Menghapus data siswa
    public function destroy(Siswa $siswa)
    {
        $siswa->delete(); // Hapus data dari database
        return response()->json(null, 204); // 204 = No Content
    }
}

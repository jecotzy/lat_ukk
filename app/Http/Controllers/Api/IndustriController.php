<?php

// Namespace dan import class yang diperlukan
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    // Menampilkan semua data industri
    public function index()
    {
        return Industri::all(); // Mengembalikan semua data industri dalam bentuk JSON
    }

    // Menyimpan data industri baru
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
            'email' => 'required|email|unique:industris,email', // email harus unik
            'website' => 'nullable|string|max:255',
        ]);

        // Menyimpan data industri ke database
        $industri = Industri::create($request->only([
            'nama', 'bidang_usaha', 'alamat', 'kontak', 'email', 'website'
        ]));

        // Response JSON jika berhasil
        return response()->json([
            'message' => 'Data industri berhasil disimpan',
            'industri' => $industri
        ], 201); // 201 = Created
    }

    // Menampilkan data industri berdasarkan ID
    public function show(string $id)
    {
        $industri = Industri::find($id);

        // Jika tidak ditemukan, kirim response error
        if (!$industri) {
            return response()->json(['message' => 'Industri tidak ditemukan'], 404);
        }

        // Jika ditemukan, kirim data industri
        return response()->json(['industri' => $industri]);
    }

    // Memperbarui data industri berdasarkan ID
    public function update(Request $request, string $id)
    {
        // Cari industri berdasarkan ID
        $industri = Industri::find($id);

        // Jika tidak ditemukan
        if (!$industri) {
            return response()->json(['message' => 'Industri tidak ditemukan'], 404);
        }

        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
            'email' => 'required|email|unique:industris,email,' . $id, // unik kecuali milik ID ini
            'website' => 'nullable|string|max:255',
        ]);

        // Update data industri
        $industri->update($request->only([
            'nama', 'bidang_usaha', 'alamat', 'kontak', 'email', 'website'
        ]));

        // Response berhasil update
        return response()->json([
            'message' => 'Data industri berhasil diperbarui',
            'industri' => $industri,
        ]);
    }

    // Menghapus data industri berdasarkan ID
    public function destroy(string $id)
    {
        // Cari industri berdasarkan ID
        $industri = Industri::find($id);

        // Jika tidak ditemukan
        if (!$industri) {
            return response()->json(['message' => 'Industri tidak ditemukan'], 404);
        }

        // Hapus data industri
        $industri->delete();

        // Response berhasil hapus
        return response()->json(['message' => 'Data industri berhasil dihapus']);
    }
}

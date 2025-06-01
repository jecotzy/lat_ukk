<?php

// Namespace dan import class yang diperlukan
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;

class PklController extends Controller
{
    // Menampilkan semua data PKL beserta relasinya (siswa, guru, industri)
    public function index()
    {
        return Pkl::with('siswa', 'guru', 'industri')->get();
        // Menggunakan eager loading untuk menghindari N+1 problem
    }

    // Menyimpan data PKL baru
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',        // Pastikan siswa ada
            'industri_id' => 'required|exists:industris,id',  // Pastikan industri ada
            'guru_id' => 'required|exists:gurus,id',          // Pastikan guru ada
            'mulai' => 'required|date',                       // Tanggal mulai harus valid
            'selesai' => 'required|date',                     // Tanggal selesai harus valid
        ]);

        // Simpan data PKL
        $pkl = Pkl::create($request->all());

        // Response sukses
        return response()->json([
            'message' => 'Data PKL berhasil disimpan',
            'pkl' => $pkl
        ], 201); // 201 = Created
    }

    // Menampilkan detail PKL berdasarkan ID
    public function show(string $id)
    {
        // Cari PKL dengan relasi siswa, guru, industri
        $pkl = Pkl::with('siswa', 'guru', 'industri')->find($id);

        // Jika tidak ditemukan, kembalikan response error
        if (!$pkl) {
            return response()->json(['message' => 'Data PKL tidak ditemukan'], 404);
        }

        // Jika ditemukan, kembalikan data PKL beserta nama relasinya
        return response()->json([
            'pkl' => $pkl,
            'siswa_nama' => $pkl->siswa?->nama,
            'industri_nama' => $pkl->industri?->nama,
            'guru_nama' => $pkl->guru?->nama,
        ]);
    }

    // Memperbarui data PKL berdasarkan ID
    public function update(Request $request, string $id)
    {
        // Cari PKL berdasarkan ID
        $pkl = Pkl::find($id);

        // Jika tidak ditemukan, return error
        if (!$pkl) {
            return response()->json(['message' => 'Data PKL tidak ditemukan'], 404);
        }

        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        // Update data PKL
        $pkl->update($request->all());

        // Muat ulang relasi agar response lengkap
        $pkl->load('siswa', 'guru', 'industri');

        // Return response sukses
        return response()->json([
            'message' => 'Data PKL berhasil diperbarui',
            'pkl' => $pkl,
            'siswa_nama' => $pkl->siswa?->nama,
            'industri_nama' => $pkl->industri?->nama,
            'guru_nama' => $pkl->guru?->nama,
        ]);
    }

    // Menghapus data PKL berdasarkan ID
    public function destroy(string $id)
    {
        // Cari PKL berdasarkan ID
        $pkl = Pkl::find($id);

        // Jika tidak ditemukan, kirim response error
        if (!$pkl) {
            return response()->json(['message' => 'Data PKL tidak ditemukan'], 404);
        }

        // Hapus data PKL
        $pkl->delete();

        // Response sukses
        return response()->json(['message' => 'Data PKL berhasil dihapus']);
    }
}

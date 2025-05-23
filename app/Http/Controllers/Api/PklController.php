<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;

class PklController extends Controller
{
    public function index()
    {
        return Pkl::with('siswa', 'guru', 'industri')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        $pkl = Pkl::create($request->all());

        return response()->json([
            'message' => 'Data PKL berhasil disimpan',
            'pkl' => $pkl
        ], 201);
    }

    public function show(string $id)
    {
        $pkl = Pkl::with('siswa', 'guru', 'industri')->find($id);

        if (!$pkl) {
            return response()->json(['message' => 'Data PKL tidak ditemukan'], 404);
        }

        return response()->json([
            'pkl' => $pkl,
            'siswa_nama' => $pkl->siswa?->nama,
            'industri_nama' => $pkl->industri?->nama,
            'guru_nama' => $pkl->guru?->nama,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $pkl = Pkl::find($id);

        if (!$pkl) {
            return response()->json(['message' => 'Data PKL tidak ditemukan'], 404);
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
        ]);

        $pkl->update($request->all());

        $pkl->load('siswa', 'guru', 'industri');

        return response()->json([
            'message' => 'Data PKL berhasil diperbarui',
            'pkl' => $pkl,
            'siswa_nama' => $pkl->siswa?->nama,
            'industri_nama' => $pkl->industri?->nama,
            'guru_nama' => $pkl->guru?->nama,
        ]);
    }

    public function destroy(string $id)
    {
        $pkl = Pkl::find($id);

        if (!$pkl) {
            return response()->json(['message' => 'Data PKL tidak ditemukan'], 404);
        }

        $pkl->delete();

        return response()->json(['message' => 'Data PKL berhasil dihapus']);
    }
}

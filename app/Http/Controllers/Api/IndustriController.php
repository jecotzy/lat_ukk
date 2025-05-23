<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    public function index()
    {
        return Industri::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
            'email' => 'required|email|unique:industris,email',
            'website' => 'nullable|string|max:255',
        ]);

        $industri = Industri::create($request->only([
            'nama', 'bidang_usaha', 'alamat', 'kontak', 'email', 'website'
        ]));

        return response()->json([
            'message' => 'Data industri berhasil disimpan',
            'industri' => $industri
        ], 201);
    }

    public function show(string $id)
    {
        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json(['message' => 'Industri tidak ditemukan'], 404);
        }

        return response()->json(['industri' => $industri]);
    }

    public function update(Request $request, string $id)
    {
        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json(['message' => 'Industri tidak ditemukan'], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
            'email' => 'required|email|unique:industris,email,' . $id,
            'website' => 'nullable|string|max:255',
        ]);

        $industri->update($request->only([
            'nama', 'bidang_usaha', 'alamat', 'kontak', 'email', 'website'
        ]));

        return response()->json([
            'message' => 'Data industri berhasil diperbarui',
            'industri' => $industri,
        ]);
    }

    public function destroy(string $id)
    {
        $industri = Industri::find($id);

        if (!$industri) {
            return response()->json(['message' => 'Industri tidak ditemukan'], 404);
        }

        $industri->delete();

        return response()->json(['message' => 'Data industri berhasil dihapus']);
    }
}

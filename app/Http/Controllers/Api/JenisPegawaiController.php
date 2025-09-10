<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisPegawaiController extends Controller
{
    public function index()
    {
        $jenisPegawais = JenisPegawai::all();
        return response()->json([
            'success' => true,
            'data' => $jenisPegawais
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pegawai' => 'required|unique:jenis_pegawais,jenis_pegawai'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $jenisPegawai = JenisPegawai::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $jenisPegawai
        ], 201);
    }

    public function show($id)
    {
        $jenisPegawai = JenisPegawai::find($id);

        if (!$jenisPegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jenisPegawai
        ]);
    }

    public function update(Request $request, $id)
    {
        $jenisPegawai = JenisPegawai::find($id);

        if (!$jenisPegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'jenis_pegawai' => 'required|unique:jenis_pegawais,jenis_pegawai,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $jenisPegawai->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $jenisPegawai
        ]);
    }

    public function destroy($id)
    {
        $jenisPegawai = JenisPegawai::find($id);

        if (!$jenisPegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $jenisPegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

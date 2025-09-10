<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatusPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = StatusPegawai::with('jenisPegawai');

        if ($request->has('jenis_pegawai_id') && $request->jenis_pegawai_id != '') {
            $query->where('jenis_pegawai_id', $request->jenis_pegawai_id);
        }

        $statusPegawais = $query->get();

        return response()->json([
            'success' => true,
            'data' => $statusPegawais
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pegawai_id' => 'required|exists:jenis_pegawais,id',
            'status_pegawai' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $statusPegawai = StatusPegawai::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $statusPegawai->load('jenisPegawai')
        ], 201);
    }

    public function show($id)
    {
        $statusPegawai = StatusPegawai::with('jenisPegawai')->find($id);

        if (!$statusPegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $statusPegawai
        ]);
    }

    public function update(Request $request, $id)
    {
        $statusPegawai = StatusPegawai::find($id);

        if (!$statusPegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'jenis_pegawai_id' => 'sometimes|required|exists:jenis_pegawais,id',
            'status_pegawai' => 'sometimes|required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $statusPegawai->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $statusPegawai->load('jenisPegawai')
        ]);
    }

    public function destroy($id)
    {
        $statusPegawai = StatusPegawai::find($id);

        if (!$statusPegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $statusPegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

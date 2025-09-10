<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgamaController extends Controller
{
    public function index()
    {
        $agamas = Agama::all();

        return response()->json([
            'success' => true,
            'data' => $agamas
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agama' => 'required|unique:agamas,agama|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $agama = Agama::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $agama
        ], 201);
    }

    public function show($id)
    {
        $agama = Agama::find($id);

        if (!$agama) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $agama
        ]);
    }

    public function update(Request $request, $id)
    {
        $agama = Agama::find($id);

        if (!$agama) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'agama' => 'sometimes|required|unique:agamas,agama,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $agama->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $agama
        ]);
    }

    public function destroy($id)
    {
        $agama = Agama::find($id);

        if (!$agama) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $agama->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

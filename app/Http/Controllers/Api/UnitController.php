<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('subunits')->get();

        return response()->json([
            'success' => true,
            'data' => $units
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit' => 'required|unique:units,unit|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $unit = Unit::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $unit->load('subunits')
        ], 201);
    }

    public function show($id)
    {
        $unit = Unit::with('subunits')->find($id);

        if (!$unit) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $unit
        ]);
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'unit' => 'sometimes|required|unique:units,unit,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $unit->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $unit->load('subunits')
        ]);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $unit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

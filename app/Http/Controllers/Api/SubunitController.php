<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subunit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubunitController extends Controller
{
    public function index(Request $request)
    {
        $query = Subunit::with('unit');

        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->where('unit_id', $request->unit_id);
        }

        $subunits = $query->get();

        return response()->json([
            'success' => true,
            'data' => $subunits
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:units,id',
            'subunit' => 'required|unique:subunits,subunit|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $subunit = Subunit::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $subunit->load('unit')
        ], 201);
    }

    public function show($id)
    {
        $subunit = Subunit::with('unit')->find($id);

        if (!$subunit) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $subunit
        ]);
    }

    public function update(Request $request, $id)
    {
        $subunit = Subunit::find($id);

        if (!$subunit) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'unit_id' => 'sometimes|required|exists:units,id',
            'subunit' => 'sometimes|required|unique:subunits,subunit,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $subunit->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $subunit->load('unit')
        ]);
    }

    public function destroy($id)
    {
        $subunit = Subunit::find($id);

        if (!$subunit) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $subunit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

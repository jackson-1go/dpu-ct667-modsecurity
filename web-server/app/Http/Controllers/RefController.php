<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefController extends Controller
{
    public function getAll()
    {
        $data = DB::table('paper_ref')
            ->whereNull('deleted_at')
            ->get();

        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'paper_id' => 'required|integer',
            'link' => 'required',
            'ref' => 'required',
        ]);

        // เพิ่ม timestamps
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $ref = DB::table('paper_ref')->insert($data);

        return response()->json([
            'success' => $ref,
            'message' => 'Reference created successfully',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'paper_id' => 'sometimes|integer',
            'link' => 'sometimes',
            'ref' => 'sometimes',
        ]);

        $ref = DB::table('paper_ref')
            ->where('id', $id)
            ->update($data);

        return response()->json(['success' => $ref]);
    }

    public function delete($id)
    {
        $ref = DB::table('paper_ref')
            ->where('id', $id)
            ->update(['deleted_at' => now()]);

        return response()->json(['success' => $ref]);
    }
}

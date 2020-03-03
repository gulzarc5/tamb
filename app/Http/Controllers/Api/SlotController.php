<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SlotController extends Controller
{
    public function slotNumbers()
    {
        $slot_data = DB::table('generated_number')->get();
        $response = [
            'status' => true,
            'message' => 'Slot Numbers',
            'data' => $slot_data,
        ];
        return response()->json($response, 200);
    }
}

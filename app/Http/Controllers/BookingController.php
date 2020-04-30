<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingComplete;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function addbooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'userId' => 'required',
            'jam' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }
        $booking = new Booking;
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function upload(Request $request)
    {
        BookingComplete::all();
        Carbon::now();
        return response()->json($out, $out['code']);
    }

    public function getallbooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

    public function getbooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

    public function editbooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

    public function deletebooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

    public function completebooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

    public function getallcompletebooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class BookingController extends Controller
{
    public function addbooking(Request $request)
    {
        $booking = new Booking;
        return response()->json($out, $out['code']);
    }

    public function upload(Request $request)
    {

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

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingComplete;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
            'endDate' => 'required',
            'namaTeam' => 'required',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $date = $request->input("date");
        $userId = $request->input("userId");
        $jam = $request->input("jam");
        $endDate = $request->input("endDate");
        $namaTeam = $request->input("namaTeam");
        $tanggal = $request->input("tanggal");

        $completeBooking = BookingComplete::where('tanggal', $tanggal)->get();
        $size = count($completeBooking);
        if ($size > 0) {
            $dates = CarbonPeriod::create($date, $endDate);
            dd($dates);
            for ($i = 0; $i < $size; $i++) {

            }
        } else {
            $booking = new Booking;
            $booking->userId = $userId;
            $booking->namaTeam = $namaTeam;
            $booking->date = $date;
            $booking->jam = $jam;
            $booking->endDate = $endDate;
            $booking->tanggal = $tanggal;
            $booking->save();
        }
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function upload(Request $request)
    {
        BookingComplete::all();
        Carbon::now();
        return response()->json($out, $out['code']);
    }

    public function getallbooking()
    {
        $booking = Booking::all();
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function getbooking($id)
    {
        $booking = Booking::find($id);
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function editbooking(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'userId' => 'required',
            'jam' => 'required',
            'endDate' => 'required',
            'namaTeam' => 'required',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $date = $request->input("date");
        $userId = $request->input("userId");
        $jam = $request->input("jam");
        $endDate = $request->input("endDate");
        $namaTeam = $request->input("namaTeam");
        $tanggal = $request->input("tanggal");

        $booking = Booking::find($id);
        $booking->userId = $userId;
        $booking->namaTeam = $namaTeam;
        $booking->date = $date;
        $booking->jam = $jam;
        $booking->endDate = $endDate;
        $booking->tanggal = $tanggal;
        $booking->update();
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function deletebooking($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function completebooking($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            $out = ['success' => false, 'message' => 'Booking Tidak Ditemukan', 'code' => 200];
        }
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function getallcompletebooking(Request $request)
    {

        return response()->json($out, $out['code']);
    }

}

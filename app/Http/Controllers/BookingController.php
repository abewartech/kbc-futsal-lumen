<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingComplete;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
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

        $completeBooking = BookingComplete::whereDate('tanggal', $tanggal)->get();
        $size = count($completeBooking);
        if ($size > 0) {
            $range = CarbonPeriod::create($date, $endDate);
            foreach ($completeBooking as $i => $value) {
                $range2 = CarbonPeriod::create($value->date, $value->endDate);
                if ($range->overlaps($range2)) {
                    return response()->json([
                        'success' => false,
                        'message' => "Lapangan sudah dibooking, silahkan cek jadwal dahulu"
                    ]);
                }
            }
            $booking = new Booking;
            $booking->userId = $userId;
            $booking->namaTeam = $namaTeam;
            $booking->date = $date;
            $booking->jam = $jam;
            $booking->endDate = $endDate;
            $booking->tanggal = $tanggal;
            $booking->save();
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
        $id = $request->input("id");
        if (!$request->hasFile('image')) {

            return response()->json(['success' => false, 'message' => "File Not Found"]);
        }

        $file = $request->file('image');

        if (!$file->isValid()) {
            return response()->json(['success' => false, 'message' => "File gagal diupload"]);
        }

        $path = public_path('images');
        $file->move($path, $file->getClientOriginalName());

        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking Tidak Ditemukan']);
        }


        $booking->image = $request->input('fileName');
        $booking->save();

        return response()->json(['success' => true, 'message' => $booking, 'code' => 200]);
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
        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking Tidak Ditemukan']);
        }
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
        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking Tidak Ditemukan']);
        }
        $booking->delete();
        $out = ['success' => true, 'message' => $booking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function completebooking($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking Tidak Ditemukan']);
        }
        $booking->delete();

        $completeBooking = BookingComplete::whereDate('tanggal', $booking->tanggal)->get();
        $size = count($completeBooking);
        if ($size > 0) {
            $range = CarbonPeriod::create($booking->date, $booking->endDate);
            foreach ($completeBooking as $i => $value) {
                $range2 = CarbonPeriod::create($value->date, $value->endDate);
                if ($range->overlaps($range2)) {
                    return response()->json([
                        'success' => false,
                        'message' => "Booking gagal di Accept, Karena lapangan sudah di booking."
                    ]);
                }
            }
            $completeBooking = new BookingComplete;
            $completeBooking->prevId = $booking->id;
            $completeBooking->userId = $booking->userId;
            $completeBooking->namaTeam = $booking->namaTeam;
            $completeBooking->date = $booking->date;
            $completeBooking->jam = $booking->jam;
            $completeBooking->endDate = $booking->endDate;
            $completeBooking->tanggal = $booking->tanggal;
            $completeBooking->save();
        } else {
            $completeBooking = new BookingComplete;
            $completeBooking->prevId = $booking->id;
            $completeBooking->userId = $booking->userId;
            $completeBooking->namaTeam = $booking->namaTeam;
            $completeBooking->date = $booking->date;
            $completeBooking->jam = $booking->jam;
            $completeBooking->endDate = $booking->endDate;
            $completeBooking->tanggal = $booking->tanggal;
            $completeBooking->save();
        }

        $out = ['success' => true, 'message' => $completeBooking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function getallcompletebooking()
    {
        $completeBooking = BookingComplete::all();
        $out = ['success' => true, 'message' => $completeBooking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function report(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'dateTo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $date = Carbon::parse($request->input("date"))->format('Y-m-d');
        $dateTo = Carbon::parse($request->input("dateTo"))->format('Y-m-d');

        $completeBooking = BookingComplete::whereBetween('tanggal', [$date, $dateTo])
            ->get();
        $out = ['success' => true, 'message' => $completeBooking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function reportpemasukan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'dateTo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $date = Carbon::parse($request->input("date"))->format('Y-m-d');
        $dateTo = Carbon::parse($request->input("dateTo"))->format('Y-m-d');

        $completeBooking = BookingComplete::whereBetween('tanggal', [$date, $dateTo])
            ->groupBy('tanggal')->select(DB::raw("count(id) as jumlah"), 'tanggal')->get();
        $out = ['success' => true, 'message' => $completeBooking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function reportmember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'dateTo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $date = Carbon::parse($request->input("date"))->format('Y-m-d');
        $dateTo = Carbon::parse($request->input("dateTo"))->format('Y-m-d');

        $completeBooking = User::where('role', 1)->whereBetween('created_at', [$date, $dateTo])
            ->get();
        $out = ['success' => true, 'message' => $completeBooking, 'code' => 200];
        return response()->json($out, $out['code']);
    }

    public function reportpembayaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'dateTo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $date = Carbon::parse($request->input("date"))->format('Y-m-d');
        $dateTo = Carbon::parse($request->input("dateTo"))->format('Y-m-d');

        $completeBooking = BookingComplete::whereBetween('tanggal', [$date, $dateTo])
            ->get();
        $out = ['success' => true, 'message' => $completeBooking, 'code' => 200];
        return response()->json($out, $out['code']);
    }
}

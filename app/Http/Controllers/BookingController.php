<?php

namespace App\Http\Controllers;

use Auth;
use App\Booking;
use App\Http\Controllers\PlaceController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use App\Http\Resources\BookingResource;
use Illuminate\Support\Facades\Date;

class BookingController extends Controller
{
    protected $user;


    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function trycall(PlaceController $data)
    {
        return $data->index();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $now = Carbon::now();
        $now = $now->format('Y-m-d');
        $place = new PlaceController;
        $data = $this->trycall($place);
        $list = $this->getDate();
        $booking = BookingResource::collection(Booking::where('date', $now)->get());
        return response()->json([
            'date' => $list,
            'place' => $data,
            'booking' => $booking,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'field_id' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);
        if (strlen($request->date) == 10){
            $date = new DateTime($request->date);
        } else{
            $temp = substr( $request->date, -10, 10);
            $date = new DateTime($temp);
        }
        $exist = null;
        $exist = Booking::where([
            ['field_id', '=' ,$request->field_id],
            ['date', '=', $date],
            ['time', '=', $request->time],
        ])->get();
        if($exist == null){
            $booking = Booking::create([
                'user_id' => $this->user->id,
                'field_id' => $request->field_id,
                'date' => $date,
                'time' => $request->time,
            ]);
            $booking->save();
            return response()->json([
                'message' => 'Successfully save booking',
                'data' => $booking,
            ], 200);
        } else{
            return response()->json([
                'message' => 'Field has been booked',
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {

        if (strlen($date) == 10){
            $date_param = new DateTime($date);
        } else{
            $temp = substr( $date, -10, 10);
            $date_param = new DateTime($temp);
        }
        $date_param = $date_param->format('Y-m-d');
        $place = new PlaceController;
        $data = $this->trycall($place);
        $list = $this->getDate();
        $booking = BookingResource::collection(Booking::where('date', $date)->get());
        return response()->json([
            'date' => $list,
            'place' => $data,
            'booking' => $booking,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDate(){
        $now = Carbon::now();
        $date = array($now->dayName." ".$now->format('d-m-Y'));
        for ($x = 1; $x<5; $x++){
            $now->addDay();
            array_push($date,$now->dayName." ".$now->format('d-m-Y'));
        }
        return $date;
    }
}

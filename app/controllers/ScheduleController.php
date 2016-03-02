<?php

class ScheduleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /schedule
	 *
	 * @return Response
	 */
	public function confirm()
	{
		/**
		schedule_id:3
		payment_id:3
		start:2016-02-18 13:00:00
		end:2016-02-18 13:45:00
		price:
		payType:0
		transactionNumber:
		checkNumber:
		paymentDate:
		bank:0
		 */

		$schedule_id = Input::get('schedule_id');
		$payment_id = Input::get('payment_id');
		$start = Input::get('start');
		$end = Input::get('end');
		$price = Input::get('price');
		$payType = Input::get('payType');
		$transactionNumber = Input::get('transactionNumber');
		$checkNumber = Input::get('checkNumber');
		$paymentDate = Input::get('paymentDate');
		$bank= Input::get('bank');
		$status = Input::get('status');
		$schedule = Schedule::find($schedule_id);
		$payment = Payment::find($payment_id);

		$schedule->start = $start;
		$schedule->end = $end;
		$schedule->status = $status;
		$schedule->save();
		if($payType != 0){
			$payment->payment_types_id = $payType;
			$payment->paycheck_number = $checkNumber;
			$payment->paycheck_date = $paymentDate;
			$payment->mount = $price;
			$payment->transaction_Number = $transactionNumber;
			$payment->banks_id = $bank;
			$payment->save();
		}
		return 1;

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /schedule/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('calendar.add');
	}
	public function TherapistCreate()
	{
		$therapist= Therapist::where('users_id',Auth::user()->id)->get()->first();
		return View::make('calendar.therapistAdd')->with(compact('therapist'));
	}


    public function save()
    {
        $patient = Input::get('patient');
        $therapist = Input::get('therapist');
        $duration = Input::get('duration');
        $start = strtotime(Input::get('start'));
        $observation = Input::get('observation');
		$price = Input::get('price');
        $duration = Duration::find($duration);
        $end = $start+ $duration->timestamp;

		$payment = new Payment();
		$payment->payment_types_id = 5;
		$payment->mount = $price;
		$payment->save();

        $schedule = new Schedule();
        $schedule->users_id = Auth::user()->id;
        $schedule->patients_id = $patient;
        $schedule->therapists_id = $therapist;
        $schedule->rooms_id = 1;
		$schedule->payments_id = $payment->id;
        $schedule->start = date("Y-m-d H:i:s",$start);
        $schedule->end =  date("Y-m-d H:i:s",$end);
        $schedule->status = 0;
        $schedule->observation = $observation;
        if($schedule->save()) {
            return Redirect::route('home')->with('Success', 'Hora Agendada Correctamente');
        }
        else{
            return "Error";
        }
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /schedule
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /schedule/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$schedule = Schedule::find(Input::get('id'));
		$patient = Patient::find($schedule->patients_id);
        $therapist = Therapist::find($schedule->therapists_id);
        $room = Room::find($schedule->rooms_id);
        if($schedule->payments_id != 0){
            $payment = Payment::find($schedule->payments_id);
        }
        $data = array(
            'patient' => array('id' => $patient->id,'name' => $patient->name,'phone' => $patient->phone,'cellphone' => $patient->cellphone,'mail' => $patient->email),
            'therapist' => array('id' => $therapist->id,'name' => $therapist->name,'phone' => $therapist->phone,'cellphone' => $therapist->cellphone),
            'room' => array('id' => $room->id,'name' => $room->name)
        );
        return json_encode($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /schedule/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pending()
	{
		$schedule = Schedule::find(Input::get('schedule_id'));
		$payment = Payment::find(Input::get('payment_id'));
		$schedule->status = 5;
		$schedule->save();
		$payment->payment_types_id = 5;
		$payment->save();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /schedule/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /schedule/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$schedule = Schedule::find(Input::get('schedule_id'));
		$schedule->delete();
		$payment = Payment::find(Input::get('payment_id'));
		$payment->delete();
	}
}
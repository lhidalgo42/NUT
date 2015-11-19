<?php

class UsersController extends \BaseController {

	public function home()
	{
        $banks = Bank::all();
        $durations = Duration::all();
        $paymentTypes = PaymentType::all();
        $schedules = Schedule::join('patients','patients.id','=','schedule.patients_id')
                            ->join('therapists','therapists.id','=','schedule.therapists_id')
                            ->select('schedule.id as schedule_id','schedule.payments_id as payment_id','schedule.status as status','patients.name as patient','therapists.name as therapist', 'schedule.payments_id as payments_id','therapists.id as therapists_id','schedule.start','schedule.end','schedule.status')->get();

        $data = array();
        $datos = array();
        foreach($schedules as $schedule){
            $data['schedule_id'] = $schedule->schedule_id;
            $data['payment_id'] = $schedule->payment_id;
            $data['title'] = $schedule->patient;
            $data['start'] = $schedule->start;
            $data['end'] = $schedule->end;
            $data['status'] = $schedule->status;
            $data['price'] = Payment::find($schedule->payments_id)->mount;
                $color = Therapist::join('colors','colors.id','=','therapists.colors_id')->where('therapists.id',$schedule->therapists_id)->get()->first();
            if($data['status'] == 5) {
                $data['borderColor'] = '#FFFFFF';
                $data['backgroundColor'] = '#000000';
                $data['textColor'] = '#FFFFFF';
            }else {
                $data['backgroundColor'] = $color->color;
                $data['textColor'] = $color->text;
                $data['borderColor'] = $color->border;
            }//$data['className'] = 'btn btn-success';
            $datos[] =  $data;
        }

        return View::make('users.home')->with(compact('datos','durations','paymentTypes','banks'));
	}
    public function create(){
        return View::make('app.users.new');
    }

}

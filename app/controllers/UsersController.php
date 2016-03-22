<?php

class UsersController extends \BaseController {

	public function home()
	{
        if (\Role::find(\Auth::user()->roles_id)->name == "Terapeuta")
            return Redirect::action('TherapistsController@calendar');

        $pendings = Payment::join('schedule','schedule.payments_id','=','payments.id')->join('patients','patients.id','=','schedule.patients_id')->where('schedule.status',2)->select('patients.name','patients.id','payments.mount')->get();
        $banks = Bank::all();
        $durations = Duration::all();
        $paymentTypes = PaymentType::all();
        $schedules = Schedule::join('patients','patients.id','=','schedule.patients_id')
                            ->join('therapists','therapists.id','=','schedule.therapists_id')
                            ->select('schedule.id as schedule_id','schedule.payments_id as payment_id','schedule.status as status','schedule.observation','patients.name as patient','therapists.name as therapist', 'schedule.payments_id as payments_id','therapists.id as therapists_id','schedule.start','schedule.end','schedule.status')->get();

        $data = array();
        $datos = array();
        foreach($schedules as $schedule){
            $data['schedule_id'] = $schedule->schedule_id;
            $data['payment_id'] = $schedule->payment_id;
            $data['title'] = $schedule->patient ."\r\n".$schedule->therapist."\r\n".$schedule->observation;
            $data['patient'] = $schedule->patient;
            $data['therapist'] = $schedule->therapist;
            $data['start'] = $schedule->start;
            $data['end'] = $schedule->end;
            $data['status'] = $schedule->status;
            $data['price'] = Payment::find($schedule->payments_id)->mount;
            $color = Therapist::join('colors','colors.id','=','therapists.colors_id')->where('therapists.id',$schedule->therapists_id)->get()->first();
            if($data['status'] == 1) {  //confirma Asistencia
                $data['className'] = 'fa fa-circle';
                $data['backgroundColor'] = $color->color;
                $data['textColor'] = $color->text;
                $data['borderColor'] = $color->border;
            }else if($data['status'] == 2) { // Pendiente / Moroso
                $data['className'] = 'fa fa-money';
                $data['backgroundColor'] = $color->color;
                $data['textColor'] = $color->text;
                $data['borderColor'] = $color->border;
            }else if($data['status'] == 3) { // Pagado y Acceptado
                $data['className'] = 'fa fa-check-square';
                $data['backgroundColor'] = $color->color;
                $data['textColor'] = $color->text;
                $data['borderColor'] = $color->border;
            }else if($data['status'] == 0){ //default
                $data['className'] = '';
                $data['backgroundColor'] = $color->color;
                $data['textColor'] = $color->text;
                $data['borderColor'] = $color->border;
            }//$data['className'] = 'btn btn-success';
            $datos[] =  $data;
        }

        return View::make('users.home')->with(compact('datos','durations','paymentTypes','banks','pendings'));
	}
    public function create(){
        return View::make('users.new');
    }
    public function config(){
        return View::make('users.config');
    }
    public function profile(){
        return View::make('users.profile');
    }
    public function history(){
        $history = Schedule::join('payments','schedule.payments_id','=','payments.id')->join('patients','patients.id','=','schedule.patients_id')->where('schedule.therapists_id','=',Auth::user()->id)->select('patients.id','patients.name','payments.mount','payments.paid','schedule.end','schedule.status')->get();
        return View::make('users.history')->with(compact('history'));
    }

}

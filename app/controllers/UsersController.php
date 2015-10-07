<?php

class UsersController extends \BaseController {

	public function home()
	{
        $schedules = Schedule::join('patients','patients.id','=','schedule.patients_id')
                            ->join('therapists','therapists.id','=','schedule.therapists_id')
                            ->select('schedule.id','patients.name as patient','therapists.name as therapist','therapists.id as therapists_id','schedule.start','schedule.end','schedule.status')->get();

        $data = array();
        $datos = array();
        foreach($schedules as $schedule){
            $data['id'] = $schedule->id;
            $data['title'] = $schedule->patient.' / '.$schedule->therapist;
            $data['start'] = $schedule->start;
            $data['end'] = $schedule->end;
                $color = Therapist::join('colors','colors.id','=','therapists.colors_id')->where('therapists.id',$schedule->therapists_id)->get()->first();
                //$data['backgroundColor'] = $color->color;
                //$data['textColor'] = $color->text;
                //$data['borderColor'] = $color->border;
                $data['className'] = 'btn btn-success';
            $datos[] =  $data;
        }

        return View::make('users.home')->with(compact('datos'));
	}
    public function create(){
        return View::make('app.users.new');
    }

}

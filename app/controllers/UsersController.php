<?php

class UsersController extends \BaseController {

	public function home()
	{
        $schedules = Schedule::join('patients','patients.id','=','schedule.patients_id')
                            ->join('therapists','therapists.id','=','schedule.therapists_id')
                            ->select('schedule.id','patients.name as patient','therapists.name as therapist','schedule.start','schedule.end','schedule.status')->get();

        $data = array();
        $datos = array();
        foreach($schedules as $schedule){
            $data['id'] = $schedule->id;
            $data['title'] = $schedule->patient.' / '.$schedule->therapist;
            $data['start'] = $schedule->start;
            $data['end'] = $schedule->end;
            if($schedule->status == 1) {
                $data['color'] = '#0000FF';
                $data['textColor'] ='#ffffff';
            }
            elseif($schedule->status == 2) {
                $data['color'] = '#FF6347';
                $data['textColor'] ='#ffffff';
            }
            else{
                $data['color'] = '#ffffff';
                $data['textColor'] ='#3c3d3d';
            }
            $datos[] =  $data;
        }

        return View::make('users.home')->with(compact('datos'));
	}
    public function create(){
        return View::make('app.users.new');
    }

}

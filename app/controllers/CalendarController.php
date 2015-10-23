<?php

class CalendarController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /calendar
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('calendar.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /calendar/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /calendar
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /calendar/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(){
        $id = Input::get('id');
		$therapist = Therapist::find($id);
        $calendar = Schedule::join('rooms','rooms.id','=','schedule.rooms_id')->join('patients','patients.id','=','schedule.patients_id')->where('therapists_id',$therapist->id)->select('patients.name as name','schedule.start','schedule.end','schedule.rooms_id','rooms.name as room','schedule.id')->get();
        foreach($calendar as $schedule){
            $datos['id'] = $schedule->id;
            $datos['title'] = $schedule->name.' / '.$schedule->room;
            $datos['start'] = $schedule->start;
            $datos['end'] = $schedule->end;
            $data[] = $datos;
        }
        return $data;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /calendar/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function byTherapist()
	{
		return View::make('calendar.byTherapist');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /calendar/{id}
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
	 * DELETE /calendar/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
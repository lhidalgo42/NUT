<?php

class ScheduleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /schedule
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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


    public function save()
    {
        $patient = Input::get('patient');
        $therapist = Input::get('therapist');
        $duration = Input::get('duration');
        $start = strtotime(Input::get('start'));
        $duration = Duration::find($duration);
        $end = $start+ $duration->timestamp;
        $schedule = new Schedule();
        $schedule->users_id = Auth::user()->id;
        $schedule->patients_id = $patient;
        $schedule->therapists_id = $therapist;
        $schedule->rooms_id = 1;
        $schedule->start = date("Y-m-d H:i:s",$start);
        $schedule->end =  date("Y-m-d H:i:s",$end);
        $schedule->status = 1;
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
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /schedule/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
	public function destroy($id)
	{
		//
	}

}
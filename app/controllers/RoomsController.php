<?php

class RoomsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /rooms
	 *
	 * @return Response
	 */
	public function index()
	{
		$rooms = Room::lists('name','id');
		$schedules = Schedule::join('therapists','therapists.id','=','schedule.therapists_id')->where('schedule.start','>',date("Y-m-d"))->select('schedule.id','therapists.name','schedule.therapists_id','schedule.start','schedule.end','schedule.rooms_id')->get();
        return View::make('rooms.index')->with(compact('schedules','rooms'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /rooms/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /rooms
	 *
	 * @return Response
	 */
	public function printer($time,$pag = 0)
	{
		$start = time();
		$end = $start;
		if($time == 'weakly'){
			$end = $end+7*24*60*60;

		}
		elseif($time == 'monthly'){
			$end = $end+28*24*60*60;
		}
		elseif($time == 'yearly'){
			$end = $end+364*24*60*60;
		}
		$start = date("Y-m-d H:i:s",$start);
		$end = date("Y-m-d H:i:s",$end);
		$schedules = Schedule::where('start','>',$start)->get();
		return $schedules;
		return View::make('rooms.printer');
	}

	/**
	 * Display the specified resource.
	 * GET /rooms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(){
		$find = $_REQUEST['query'];
        $rooms = Room::where('name', 'like', $find.'%')->get();
        return $rooms;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /rooms/{id}/edit
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
	 * PUT /rooms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$room = Input::get('room');
		$schedule = Input::get('schedule');
		$schedule = Schedule::find($schedule);
		$schedule->rooms_id = $room;
		$schedule->save();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /rooms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
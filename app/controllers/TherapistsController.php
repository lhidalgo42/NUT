<?php

class TherapistsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /therapists
	 *
	 * @return Response
	 */
	public function index()
	{
		$therapists = Therapist::all();
		return View::make('therapists.index')->with(compact('therapists'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /therapists/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /therapists
	 *
	 * @return Response
	 */
	public function duration()
	{
		$id = Input::get('id');
        $durations = TherapistDuration::join('duration','therapists_duration.duration_id','=','duration.id')->where('therapists_duration.therapists_id',$id)->get();
        return $durations;

	}

    public function durationNew()
    {
        $id = Input::get('id');
        $ids = TherapistDuration::join('duration','therapists_duration.duration_id','=','duration.id')->where('therapists_duration.therapists_id',$id)->select('duration.id')->get()->toArray();
        $durations = Duration::whereNotIn('id',$ids)->get();
        return $durations;

    }

    public function durationDelete()
    {
        $id = Input::get('id');
        $therapist = Input::get('therapist');
        $therapist =  TherapistDuration::where('therapists_id',$therapist)->where('duration_id',$id)->get()->first();
        $therapist->delete();
    }

    public function durationSave()
    {
        $id = Input::get('id');
        $therapist = Input::get('therapist');
        $therapistDuration = new TherapistDuration();
        $therapistDuration->therapists_id = $therapist;
        $therapistDuration->duration_id = $id;
        $therapistDuration->save();
        return 1;
    }
    public function configDuracion(){
        return View::make('therapists.config');
    }

	/**
	 * Display the specified resource.
	 * GET /therapists/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        $find = Input::get('name');
        $therapists = Therapist::where('name', 'like', $find.'%')->get();
        return $therapists;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /therapists/{id}/edit
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
	 * PUT /therapists/{id}
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
	 * DELETE /therapists/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
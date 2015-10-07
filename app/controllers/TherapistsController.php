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
        $therapist = new Therapist();
        $therapist->rut = Input::get('rut');
        $therapist->name = Input::get('name');
        $therapist->birth = Input::get('birth');
        $therapist->phone = Input::get('phone');
        $therapist->cellphone = Input::get('cellphone');
        $therapist->email = Input::get('email');
        $therapist->colors_id = 1;
        $therapist->save();
        return $therapist;
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
	public function showList()
	{
        $find = Input::get('name');
        $therapists = Therapist::where('name', 'like', $find.'%')->get()->take(15);
        return $therapists;
	}


    /**
     * Show the form for editing the specified resource.
     * GET /patients/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Therapist::find($id);
    }

    /**
     * Update the specified resource in storage.
     * PUT /patients/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        $therapist = Therapist::find(Input::get('id'));
        $therapist->rut = Input::get('rut');
        $therapist->name = Input::get('name');
        $therapist->birth = Input::get('birth');
        $therapist->phone = Input::get('phone');
        $therapist->cellphone = Input::get('cellphone');
        $therapist->email = Input::get('email');
        $therapist->save();
        return $therapist;
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /patients/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $exist = Schedule::where('therapists_id','=',$id)->count();
        if($exist == 0) {
            $therapist = Therapist::find($id);
            $therapist->delete();
        }
        else{
            return Redirect::route('home')->with('No puede Borrar un Paciente que Tenga Horas Asignadas.');
        }

    }

}
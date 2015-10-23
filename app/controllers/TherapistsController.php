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
        for ($i=0;$i<count($therapists);$i++){
            $therapists[$i]->birth = date('d-m-Y', strtotime($therapists[$i]->birth));
        }
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
        $user = new User();
        $therapist = new Therapist();
        $user->email = Input::get('email');
        $user->password =substr(Input::get('rut'),strlen(Input::get('rut'))-4,strlen(Input::get('rut')));
        $user->img = 'avatar_2x.png';
        $user->name = Input::get('name');
        $user->roles_id = 3;
        $user->save();
        $therapist->rut = Input::get('rut');
        $therapist->name = Input::get('name');
        $therapist->birth = date('Y-m-d', strtotime(Input::get('birth')));
        $therapist->phone = Input::get('phone');
        $therapist->cellphone = Input::get('cellphone');
        $therapist->email = Input::get('email');
        $therapist->users_id = $user->id;
        $therapist->save();
        foreach(range(3,5) as $id) {
            $durations = new TherapistDuration();
            $durations->therapists_id = $therapist->id;
            $durations->duration_id = $id;
            $durations->save();
            }
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
            $user = User::find($therapist->users_id);
            $user->delete();
            $therapist->delete();
        }
        else{
            return Redirect::route('home')->with('No puede Borrar un Paciente que Tenga Horas Asignadas.');
        }

    }

    public function color(){
        $therapist = Therapist::find(Input::get('therapist'));
        $therapist->colors_id = Input::get('color');
        $therapist->save();
    }

    public function access(){
        $therapist = Therapist::find(Input::get('therapist'));
        $user = User::find($therapist->users_id);
        $user->access = Input::get('access');
        $user->save();
    }
    public function calendar(){
        $therapist = Therapist::where('users_id',Auth::user()->id)->get()->first();
        return View::make('therapists.calendar')->with(compact('therapist'));
    }
    public function durations(){
        $therapist = Therapist::where('users_id',Auth::user()->id)->get()->first();
        return View::make('therapists.durations')->with(compact('therapist'));
    }

}
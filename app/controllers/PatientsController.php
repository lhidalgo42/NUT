<?php

class PatientsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /patients
	 *
	 * @return Response
	 */
	public function index()
	{
		$patients = Patient::all();
		for ($i=0;$i<count($patients);$i++){
			$patients[$i]->birth = date('d-m-Y', strtotime($patients[$i]->birth));
		}
        return View::make('patients.index')->with(compact('patients'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /patients/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$patient = new Patient();
        $patient->rut = Input::get('rut');
        $patient->name = Input::get('name');
        $patient->birth = date('Y-m-d', strtotime(Input::get('birth')));
        $patient->phone = Input::get('phone');
        $patient->cellphone = Input::get('cellphone');
        $patient->email = Input::get('email');
		$patient->addedByUserId = Auth::user()->id;
        $patient->save();
        return $patient;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /patients
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /patients/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showList(){
        $find = Input::get('name');
        $patients = Patient::where('name', 'like', $find.'%')->get()->take(15);
        return $patients;
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
		return Patient::find($id);
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
		$patient = Patient::find(Input::get('id'));
        $patient->rut = Input::get('rut');
        $patient->name = Input::get('name');
        $patient->birth = Input::get('birth');
        $patient->phone = Input::get('phone');
        $patient->cellphone = Input::get('cellphone');
        $patient->email = Input::get('email');
        $patient->save();
        return $patient;
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
        $exist = Schedule::where('patients_id','=',$id)->count();
        if($exist == 0) {
            $patient = Patient::find($id);
            $patient->delete();
        }
        else{
            return Redirect::route('home')->with('No puede Borrar un Paciente que Tenga Horas Asignadas.');
        }
	}
	public function exist(){
		$rut = Input::get('rut');
		$exist = Patient::where('rut','like','%'.$rut.'%')->count();
		return json_encode(array('result' => $exist));
	}

	public function debt(){
		$id = Input::get('id');
		$patient = Schedule::where('patients_id','=',$id)->where('status','=',2)->count();
		return json_encode(array('result' => $patient));
	}

}
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
        return View::make('patients.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /patients/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	public function show(){
        $find = $_REQUEST['query'];
        $patients = Patient::where('name', 'like', $find.'%')->get();
        return $patients;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /patients/{id}/edit
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
	 * PUT /patients/{id}
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
	 * DELETE /patients/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
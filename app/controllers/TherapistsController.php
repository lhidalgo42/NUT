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
	public function store()
	{
		//
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
        $find = $_REQUEST['query'];
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
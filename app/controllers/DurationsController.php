<?php

class DurationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /durations
	 *
	 * @return Response
	 */
	public function index()
	{
		$durations = Duration::all();
		return $durations;
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /durations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$duration = new Duration();
		$duration->name = (Input::get('timestamp')/60 ).' Minutos';
		$duration->timestamp = Input::get('timestamp');
		$duration->save();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /durations
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /durations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$duration = Duration::find($id);
		return $duration;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /durations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$duration = Duration::find($id);
		$duration->name = Input::get('name');
		$duration->timestamp = Input::get('timestamp');
		$duration->save();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /durations/{id}
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
	 * DELETE /durations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$duration = Duration::find($id);
		$duration->destroy();
	}

}
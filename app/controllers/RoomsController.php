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
        return View::make('rooms.index');
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
	public function store()
	{
		//
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
	public function update($id)
	{
		//
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
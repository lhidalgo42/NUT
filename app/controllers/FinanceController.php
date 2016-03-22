<?php

class FinanceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /finance
	 *
	 * @return Response
	 */
	public function therapists()
	{
		$therapists = Schedule::join('payments','schedule.payments_id','=','payments.id')->join('therapists','therapists.id','=','schedule.therapists_id')->where('payments.paid','=',0)->where('schedule.status','=',3)->groupBy('schedule.therapists_id')->select('therapists.name','therapists.id',DB::raw('sum(payments.mount) as mount'))->get();
		return View::make('finance.therapists')->with(compact('therapists'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /finance/create
	 *
	 * @return Response
	 */
	public function income()
	{
		$payments = Payment::join('schedule','schedule.payments_id','=','payments.id')->join('patients','patients.id','=','schedule.patients_id')->where('schedule.status',3)->select('patients.name','patients.id','payments.mount','schedule.end')->get();
		return View::make('finance.income')->with(compact('payments'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /finance
	 *
	 * @return Response
	 */
	public function expenses()
	{
		return View::make('finance.expenses');
	}

	/**
	 * Display the specified resource.
	 * GET /finance/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function voucher()
	{
		return View::make('finance.voucher');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /finance/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function patients()
	{
		$payments = Payment::join('schedule','schedule.payments_id','=','payments.id')->join('patients','patients.id','=','schedule.patients_id')->where('schedule.status',2)->select('patients.name','patients.id','payments.mount','schedule.end')->get();
		return View::make('finance.patients')->with(compact('payments'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /finance/{id}
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
	 * DELETE /finance/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
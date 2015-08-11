<?php

class UsersController extends \BaseController {

	public function home()
	{
        return View::make('users.home');
	}
    public function create(){
        return View::make('app.users.new');
    }

}

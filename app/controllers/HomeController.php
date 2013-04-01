<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		$activities = Activity::where('sat_total', '>', '0')->get();
		$activity_list = View::make('activity.table', compact('activities'));

		$this->layout->content = View::make('welcome', compact('activity_list'));
	}

}

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*-------------------------------------------------------------------------------------------------
// ! Index
-------------------------------------------------------------------------------------------------*/
Route::get('/', 'IndexController@getIndex');


/*-------------------------------------------------------------------------------------------------
// ! User
Explicit Routing
-------------------------------------------------------------------------------------------------*/
# Note: the beforeFilter for 'guest' on getSignup and getLogin is handled in the Controller
Route::get('/signup', 'UserController@getSignup'); 
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );


/*-------------------------------------------------------------------------------------------------
# ! Croc
Explicit Routing
-------------------------------------------------------------------------------------------------*/

Route::get('/croc', 'CrocController@getIndex');
Route::get('/croc/alligators', 'CrocController@getAlligators');
Route::get('/croc/crocodiles', 'CrocController@getCrocodiles');
Route::get('/croc/gharials', 'CrocController@getGharials');
Route::get('/croc/edit/{id}', 'CrocController@getEdit');
Route::post('/croc/edit/{id}', 'CrocController@postEdit');
Route::get('/croc/create', 'CrocController@getCreate');
Route::post('/croc/create', 'CrocController@postCreate');


/******************************************/

# List crocodilians/search results of crocodilians
Route::get('/list/{format?}', function($format = 'html') {


	$query = Input::get('query');


	# If there is a query, search the library with that query
	if($query) {


	$crocs = Croc::where('species', 'LIKE', "%$query%")
		->orWhere('name', 'LIKE', "%$query%")
		->orWhere('image', 'LIKE', "%$query%")
		->get();


	}
	# Otherwise, just fetch all crocs
	else {
		$crocs = Croc::all();	
	}

	# Decide on output method...
	# Default - HTML
	if($format == 'html') {
		return View::make('list')
			->with('crocs', $crocs)
			->with('query', $query);
	}
	# JSON
	elseif($format == 'json') {
		return Response::json($crocs);
	}
	# PDF (Coming soon)
	elseif($format == 'pdf') {
		return "This is the pdf (Coming soon).";
	}	
});


/**********************************************************************
				Adding crocs to the database
**********************************************************************/
# Display add form
Route::get('/add/', 
	array( 
		'before' => 'auth', function() {


			return View::make('croc_create');


}));


# Process add form
Route::post('/add/', 
	array(
        'before' => 'auth', function() {




	# Instantiate the croc model
	$croc = new Croc();




	$croc->name = Input::get('name');
	$croc->family = Input::get('family');
	$croc->species = Input::get('species');
	$croc->habitat = Input::get('habitat');
	$croc->appearance = Input::get('appearance');
	$croc->image = Input::get('image');
	$croc->fact1 = Input::get('fact1');
	$croc->fact2 = Input::get('fact2');
	$croc->fact3 = Input::get('fact3');




	# Magic: Eloquent
	$croc->save();




	return Redirect::action('CrocController@getIndex')->with('flash_message','Your croc has been added.');



}));


/*-------------------------------------------------------------------------------------------------
// ! CRUD Demo
Explicit Routing
-------------------------------------------------------------------------------------------------*/
Route::get('/crud-create', 'DemoController@crudCreate');
Route::get('/crud-read', 'DemoController@crudRead');
Route::get('/crud-update', 'DemoController@crudUpdate');
Route::get('/crud-delete', 'DemoController@crudDelete');


/*-------------------------------------------------------------------------------------------------
// ! Debug
Implicit
-------------------------------------------------------------------------------------------------*/
# Implicit routing
Route::controller('debug', 'DebugController');


/*
# Explicit routing
Route::get('/debug/', 'DebugController@index');
Route::get('/debug/trigger-error', 'Debug Controller@triggerError');
Route::get('/debug/routes', 'DebugController@routes');
*/


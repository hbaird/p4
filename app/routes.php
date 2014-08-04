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


/******************************************/

# List crocodilians/search results of crocodilians
Route::get('/list/{format?}', function($format = 'html') {


	$query = Input::get('query');


	# If there is a query, search the library with that query
	if($query) {


	# Here's a better option because it searches across multiple fields
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


# Display add form
Route::get('/add/', 
	/*array( 
		'before' => 'auth',*/ function() {

			return View::make('add');

})/*)*/;

# Process add form
Route::post('/add/', 
	/*array(
        'before' => 'auth',*/ function() {


	//echo Pre::render(Input::all());


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


	return "Added a new croc";

})/*)*/;

# Quickly seed books table for demonstration purposes
Route::get('/seed', function() {


	$query = "INSERT INTO `crocs` (`created_at`, `updated_at`, `name`, 'family', `species`, `region`, `appearance`, `image`)
	VALUES
	('2014-07-26 21:38:00','2014-07-26 21:38:00','American Alligator', 'Alligatoridae', 'Alligator mississippiensis','Most Commonly Inhabited Regions: Southeastern United States: Alabama, Arkansas, North & South Carolina, Florida, Georgia, Louisiana, Mississippi, Oklahoma, Texas', 'Size: The adult male averages 3.4 meters long and weighs over 500 pounds. The adult female averages 2.6 meters and weights slightly more than 200 pounds.','/public/images/americanall2.jpg'),
	('2014-07-26 21:38:00','2014-07-26 21:38:00','Spectacled Caiman', 'Alligatoridae','Caiman crocodilus','Most Commonly Inhabited Regions: Brazil, Colombia, Costa Rica, Ecuador, El Salvador, Guyana, French Guiana, Guatemala, Honduras, Mexico, Nicaragua, Panama, Peru, Suriname, Tobago, Trinidad, and Venezuela', 'Size: The adult male averages 2 to 2.5 meters long. The adult female averages 1.4 meters. Most adults weigh between 15 and 88 pounds.','/public/images/speccaiman2.jpg'),
	";


	DB::statement($query);


	return $query;


}); 



Route::get('/practice-create', function() {


	# Instantiate the crocodilian model
	$croc = new Croc();


	$croc->name = 'American Alligator';
	$croc->family = 'Alligatoridae';
	$croc->species = 'Official Name: Alligator mississippiensis';
	$croc->habitat = 'Most Commonly Inhabited Regions: Southeastern United States: Alabama, Arkansas, North & South Carolina, Florida, Georgia, Louisiana, Mississippi, Oklahoma, Texas';
	$croc->appearance = 'Size: The adult male averages 3.4 meters long and weighs over 500 pounds. The adult female averages 2.6 meters and weights slightly more than 200 pounds.';
	$croc->image = 'http://p4-hbaird.rhcloud.com/images/americanall2.jpg';


	# Magic: Eloquent
	$croc->save();


	return "You added a new croc.";


});

Route::get('/practice-read', function() {


	//$croc = new Croc();


	# Magic: Eloquent
	$crocs = Croc::all();


	# Debugging
	foreach($crocs as $croc) {
		echo $croc->name."<br>";
	}




});

Route::get('/practice-update', function() {

	$croc = Croc::find(1);


	$croc->image = 'Chomper';


	$croc->save();


	echo "You updated a croc.";


});

Route::get('/practice-delete', function() {


	$croc = Croc::find(3);


	$croc->delete();


	echo "This croc has been deleted.";


});


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


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

# Home page
Route::get('/', function() {
	return View::make('index');				
});



/*****Debugging environments*******/

//Get environmnet
Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

//Check error reporting
Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});

# /app/routes.php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


/******************************************/

# List crocodilians/search results of crocodilians
Route::get('/list/{format?}', function($format = 'html') {


	$query = Input::get('query');


	# If there is a query, search the library with that query
	if($query) {


	# Here's a better option because it searches across multiple fields
	$crocodilians = Crocodilian::where('species', 'LIKE', "%$query%")
		->orWhere('name', 'LIKE', "%$query%")
		->orWhere('image', 'LIKE', "%$query%")
		->get();


	}
	# Otherwise, just fetch all crocs
	else {
		$crocodilians = Crocodilian::all();	
	}

	# Decide on output method...
	# Default - HTML
	if($format == 'html') {
		return View::make('list')
			->with('crocodilians', $crocodilians)
			->with('query', $query);
	}
	# JSON
	elseif($format == 'json') {
		return Response::json($crocodilians);
	}
	# PDF (Coming soon)
	elseif($format == 'pdf') {
		return "This is the pdf (Coming soon).";
	}	
});

# Display edit form
Route::get('/edit/{title}', function() {


});


# Process edit form
Route::post('/edit/{title}', function() {


});

# Display add form
Route::get('/add/', function() {


	return View::make('add');


});

# Process add form
Route::post('/add/', function() {


	//echo Pre::render(Input::all());


	# Instantiate the crocodilian model
	$crocodilian = new Book();


	$crocodilian->name = Input::get('name');
	$crocodilian->species = Input::get('species');
	$crocodilian->origin = Input::get('origin');
	$crocodilian->appearance_spec = Input::get('appearance');
	$crocodilian->image = Input::get('image');


	# Magic: Eloquent
	$crocodilian->save();


	return "Added a new crocodilian";


});

# Quickly seed books table for demonstration purposes
Route::get('/seed', function() {


	$query = "INSERT INTO `crocodilians` (`created_at`, `updated_at`, `name`, `species`, `region`, `appearance`, `image`)
	VALUES
	('2014-07-26 21:38:00','2014-07-26 21:38:00','American Alligator','Alligator mississippiensis','Most Commonly Inhabited Regions: Southeastern United States: Alabama, Arkansas, North & South Carolina, Florida, Georgia, Louisiana, Mississippi, Oklahoma, Texas', 'Size: The adult male averages 3.4 meters long and weighs over 500 pounds. The adult female averages 2.6 meters and weights slightly more than 200 pounds.','/public/images/americanall2.jpg'),
	('2014-07-26 21:38:00','2014-07-26 21:38:00','Spectacled Caiman','Caiman crocodilus','Most Commonly Inhabited Regions: Brazil, Colombia, Costa Rica, Ecuador, El Salvador, Guyana, French Guiana, Guatemala, Honduras, Mexico, Nicaragua, Panama, Peru, Suriname, Tobago, Trinidad, and Venezuela', 'Size: The adult male averages 2 to 2.5 meters long. The adult female averages 1.4 meters. Most adults weigh between 15 and 88 pounds.','/public/images/speccaiman2.jpg'),
	";


	DB::statement($query);


	return $query;


}); 

Route::get('/mysql-connection-test', function() {


	$results = DB::select('SHOW DATABASES;');


	return Pre::render($results, 'Results');


});

Route::get('/practice-create', function() {


	# Instantiate the crocodilian model
	$crocodilian = new Crocodilian();


	$crocodilian->name = 'American Alligator';
	$crocodilian->species = 'Official Name: Alligator mississippiensis';
	$crocodilian->region = 'Most Commonly Inhabited Regions: Southeastern United States: Alabama, Arkansas, North & South Carolina, Florida, Georgia, Louisiana, Mississippi, Oklahoma, Texas';
	$crocodilian->appearance = 'Size: The adult male averages 3.4 meters long and weighs over 500 pounds. The adult female averages 2.6 meters and weights slightly more than 200 pounds.';
	$crocodilian->image = 'http://p4-hbaird.rhcloud.com/images/americanall2.jpg';


	# Magic: Eloquent
	$crocodilian->save();


	return "You added a new croc.";


});

Route::get('/practice-read', function() {


	//$crocodilian = new Crocodilian();


	# Magic: Eloquent
	$crocodilians = Crocodilian::all();


	# Debugging
	foreach($crocodilians as $crocodilian) {
		echo $crocodilian->name."<br>";
	}




});

Route::get('/practice-update', function() {

	$crocodilian = Crocodilian::find(1);


	$crocodilian->image = 'Chomper';


	$crocodilian->save();


	echo "You updated a croc.";


});

Route::get('/practice-delete', function() {


	$crocodilian = Crocodilian::find(1);


	$crocodilian->delete();


	echo "This croc has been deleted.";


});
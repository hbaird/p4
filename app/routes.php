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


Route::get('/mysql-connection-test', function() {


	$results = DB::select('SHOW DATABASES;');


	return Pre::render($results, 'Results');


});

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

/**********User Authentication********************/


// app/routes.php`:

Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);


Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->email    = Input::get('email');

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            Auth::login($user);

            return Redirect::to('/list')->with('flash_message', 'Welcome to Foobooks!');

        }
    )
);


Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);


Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('login');
        }
    )
);


# /app/routes.php
Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});




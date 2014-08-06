<?php


class CrocController extends \BaseController {




	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function __construct() {


	}




	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getSearch() {


		return View::make('croc_search');


	}




	/*-------------------------------------------------------------------------------------------------
	http://localhost/croc/search
	Demonstrate of Ajax
	-------------------------------------------------------------------------------------------------*/
	public function postSearch() {


		if(Request::ajax()) {


			$query  = Input::get('query');


			# We're demoing two possible return formats: JSON or HTML
			$format = Input::get('format');


			# Do the actual query
	        $crocs  = Croc::search($query);


	        # If the request is for JSON, just send the books back as JSON
	        if($format == 'json') {
		        return Response::json($crocs);
	        }
	        # Otherwise, loop through the results building the HTML View we'll return
	        elseif($format == 'html') {




		        $results = '';	        
				foreach($crocs as $croc) {
					# Created a "stub" of a view called croc_search_result.php; all it is is a stub of code to display a croc
					# For each croc, we'll add a new stub to the results
					$results .= View::make('croc_search_result')->with('croc', $croc)->render();   
				}


				# Return the HTML/View to JavaScript...
				return $results;
			}
		}
	}




	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getIndex() {


		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');


		$query  = Input::get('query');


		$crocs = Croc::search($query);


		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('croc_index')
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




	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getEdit($id) {


		$croc = Croc::findOrFail($id);


		return View::make('croc_edit')
			->with('croc', $croc);


	}




	/*-------------------------------------------------------------------------------------------------


	-------------------------------------------------------------------------------------------------*/
	public function postEdit($id) {


		$croc = Croc::findOrFail($id);
		$croc->fill(Input::all());
		$croc->save();


		return Redirect::action('CrocController@getIndex')->with('flash_message','Your changes have been saved.');


	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getCreate() {

		return View::make('croc_create');

	}

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function postCreate() {


		# Instantiate the book model
		$croc = new Croc();


		$croc->fill(Input::all());
		$croc->save();


		# Magic: Eloquent
		$croc->save();


		return Redirect::action('CrocController@getIndex')->with('flash_message','Your croc has been added.');


	}

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getAlligators() {


		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');

		$crocs = Croc::where('family', 'LIKE', "%Alligatoridae%")
			->get();

		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('family_index')
				->with('crocs', $crocs);
		}
		# JSON
		elseif($format == 'json') {
			return Response::json($crocs);
		}
		# PDF (Coming soon)
		elseif($format == 'pdf') {
			return "This is the pdf (Coming soon).";
		}

	}

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getCrocodiles() {

		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');

		$crocs = Croc::where('family', 'LIKE', "%Crocodylidae%")
			->get();

		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('family_index')
				->with('crocs', $crocs);
		}
		# JSON
		elseif($format == 'json') {
			return Response::json($crocs);
		}
		# PDF (Coming soon)
		elseif($format == 'pdf') {
			return "This is the pdf (Coming soon).";
		}

	}

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getGharials() {

		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');

		$crocs = Croc::where('family', 'LIKE', "%Gavialidae%")
			->get();

		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('family_index')
				->with('crocs', $crocs);
		}
		# JSON
		elseif($format == 'json') {
			return Response::json($crocs);
		}
		# PDF (Coming soon)
		elseif($format == 'pdf') {
			return "This is the pdf (Coming soon).";
		}

	}
}

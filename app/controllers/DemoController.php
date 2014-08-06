<?php


class DemoController extends BaseController {




	public function csrf() {


		return View::make('demo_csrf');

	}


	public function crudCreate() {

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
	}


	public function crudRead () {

		# Magic: Eloquent
		$crocs = Croc::all();


		# Debugging
		foreach($crocs as $croc) {
			echo $croc->name."<br>";
		}

	}

	
	public function crudUpdate() {

		$croc = Croc::find(1);


		$croc->image = 'Chomper';


		$croc->save();


		echo "You updated a croc.";
	
	}


	public function crudDelete() {

		$croc = Croc::find(2);


		$croc->delete();


		echo "This croc has been deleted.";
		
	}

}

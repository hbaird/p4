<?php 


class Croc extends Eloquent { 

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public static function search($query) {

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

}

}

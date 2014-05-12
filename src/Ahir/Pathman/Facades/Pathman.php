<?php namespace Ahir\Pathman\Facades;

use Illuminate\Support\Facades\Facade;

class Pathman extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'pathman'; }

}
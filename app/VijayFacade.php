<?php 
namespace App;
use Illuminate\Support\Facades\Facade;
class VijayFacade extends Facade {
	protected static function getFacadeAccessor(){
    	return Vijay::class;
    }
}

?>
<?php
namespace ArtinCMS\LLS;
use Illuminate\Support\Facades\Facade;

class LLSFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'LLS';
	}
}
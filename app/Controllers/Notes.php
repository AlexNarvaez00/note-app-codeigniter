<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Coolpraz\PhpBlade\PhpBlade;

class Notes extends BaseController
{
	public function index()
	{
		$views = __DIR__.'/../Views';
		$cache = __DIR__.'/../../vendor/cache';

		$bladeObj = new PhpBlade($views,$cache);
		echo $bladeObj->view()->make('home');
	}
}

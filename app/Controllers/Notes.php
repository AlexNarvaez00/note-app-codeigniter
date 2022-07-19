<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Coolpraz\PhpBlade\PhpBlade;

class Notes extends BaseController
{
	public function index()
	{
		$views = __DIR__.'/../Views';

		$bladeObj = new PhpBlade($views,null);
		return $bladeObj->view()->make('home');
	}
}

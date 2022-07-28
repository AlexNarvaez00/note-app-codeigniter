<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Coolpraz\PhpBlade\PhpBlade;

/**
 * @author Narvaez Ruiz Alexis 
 * Controlador para registar un usuario
 */
class Register extends BaseController
{
	private $views;
	private $cache;
	private $bladeObj;
	public function __construct()
	{
		$this->views = __DIR__ . '/../Views';
		$this->cache = __DIR__ . '/../../vendor/cache';
		$this->bladeObj = new PhpBlade($this->views, $this->cache);
	}


	public function index()
	{
		 return $this->bladeObj->view()->make('notes.home', [])->render();
	}
}

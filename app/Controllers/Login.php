<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Coolpraz\PhpBlade\PhpBlade;

/**
 *@author Narvaez Ruiz Alexis
 * Controlador para el login  
 */
class Login extends BaseController
{
	//Helper para iniciar sesion
	protected $helpers = ['auth', 'setting'];

	//Variables para las vistas de blade
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
		return $this->bladeObj->view()->make('auth.login', [])->render();
	}
	/**
	 * Funcion para iniciar sesion
	 */
	public function login()
	{
		//Recuperamos la informacion del formulario
		$credentials = [
			'email'    => $this->request->getPost('email'),
			'password' => $this->request->getPost('password')
		];
		$loginStatus = auth()->attempt($credentials);
		if ($loginStatus->isOK()) {
			return redirect()->to(base_url('/notes'));
		} else {
			echo "No se pudo iniciar session";
		}
	}
	/**
	 * Funcion para salir
	 */
	public function logout()
	{
		auth()->logout();
		return redirect()->to(base_url() . '/login');
	}
}

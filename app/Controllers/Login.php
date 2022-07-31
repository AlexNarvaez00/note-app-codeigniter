<?php

namespace App\Controllers;

use App\Controllers\BaseController;

/**
 *@author Narvaez Ruiz Alexis
 * Controlador para el login  
 */
class Login extends BaseController
{
	//Helper para iniciar sesion
	protected $helpers = ['auth', 'setting'];

	public function __construct()
	{
	}

	public function index()
	{
		return view('auth/login');
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

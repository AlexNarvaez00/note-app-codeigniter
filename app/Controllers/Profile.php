<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile as ModelsProfile;
use Coolpraz\PhpBlade\PhpBlade;

class Profile extends BaseController
{
	protected $helpers = ['auth', 'setting'];
	//Variables de la vista
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
		if (auth()->loggedIn()) {

			//Este areglo de usa para marcar en donde esta parada la vista
			$data['indexList'] = [
				[
					'name' => 'Notes',
					'link' => '/note'
				],
				[
					'name'  => 'profile',
					'active' => true
				]
			];
			$data['user'] = ['username' => auth()->getUser()->username];
			//Buscamos la informacion del usuario
			$profiles = new ModelsProfile();
			$profile = $profiles->where('idUser',auth()->getUser()->id)->findAll();
			$data['profile'] = $profile[0];
			return $this->bladeObj->view()->make('profile.profile', $data)->render();
		} else {
			return redirect()->to('/login');
		}
	}
}

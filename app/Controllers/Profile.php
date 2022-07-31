<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile as ModelsProfile;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use PhpParser\Node\Expr\FuncCall;

class Profile extends BaseController
{
	protected $helpers = ['auth', 'setting'];
	//Variables de la vista
	public function __construct()
	{
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
			$profile = $profiles->where('idUser', auth()->getUser()->id)->findAll();
			$data['profile'] = $profile[0];
			return view('profile/profile', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function edit($id)
	{
		//Este areglo de usa para marcar en donde esta parada la vista
		$data['indexList'] = [
			[
				'name' => 'Notes',
				'link' => '/note'
			],
			[
				'name'  => 'profile',
				'active' => false
			],
			[
				'name' => auth()->getUser()->id,
				'active' => false
			],
			[
				'name' => 'edit',
				'active' => true
			]
		];
		$data['user'] = ['username' => auth()->getUser()->username];
		//Buscamos la informacion del usuario
		$profiles = new ModelsProfile();
		$profile = $profiles->where('idUser', auth()->getUser()->id)->findAll();
		$data['profile'] = $profile[0];
		return view('profile/edit', $data);
	}
	public function update($id)
	{
		$users = new UserModel();
		$profiles = new ModelsProfile();
		$profile = $profiles->where('idUser',auth()->getUser()->id)->findAll();
		$this->validate([
			
		]);
	}
}

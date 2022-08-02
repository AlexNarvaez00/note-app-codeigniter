<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile as ModelsProfile;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;
use PhpParser\Node\Expr\FuncCall;
use CodeIgniter\Shield\Authentication\Passwords;
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

		session();
		$data['errors'] = \Config\Services::validation();

		return view('profile/edit', $data);
	}
	public function update($id)
	{
		$users = new UserModel();
		$profiles = new ModelsProfile();
		$profile = $profiles->where('idUser', auth()->getUser()->id)->findAll();
		if (strcmp($this->request->getPost('type-informacion'), 'personal') == 0) {
			$data = [];
			if ($this->validate('profiles_personal')) {
				$data = [
					'id' => $profile[0]['id'],
					//'imgProfile' => $imgName,
					'workstation' => $this->request->getPost('workstation'),
					'cellphone' => $this->request->getPost('cellphone'),
				];
				$profiles->save($data);
				return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
			} else {
				return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
			}
			if (strcmp($this->request->getPost('username'), '') != 0 && $this->validate(
				['username' => array_merge(
					config('AuthSession')->usernameValidationRules,
					['is_unique[users.username]']
				)]
			)) {
				$dataUser = [
					'id' => auth()->getUser()->id,
					'username' => $this->request->getPost('username')
				];
				$userUpdate = new User($dataUser);
				$users->save($userUpdate);
			} else {
				return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
			}
			if (strcmp($this->request->getPost('password'), '') != 0 && strcmp($this->request->getPost('password_confirm'), '') != 0) {
				if ($this->validate([
					'password'         => 'required|strong_password',
					'password_confirm' => 'required|matches[password]',
				])) {
					$identity =new UserIdentityModel();
					$UserIdentityData = $identity->where('user_id',auth()->getUser()->id)->findAll();
					$userUpdateIdentity = [
						'id' => $UserIdentityData[0]['id'],
						'secret2' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT)
					];
					$identity->save($userUpdateIdentity);
				}
				return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
			}


			return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
		} elseif (strcmp($this->request->getPost('type-informacion'), 'social') == 0) {
			if ($this->validate('profiles_social')) {
				$data = [
					'id' => $profile[0]['id'],
					//'imgProfile' => $imgName,
					//'workstation' => $this->request->getPost('workstation'),
					'github_link' => $this->request->getPost('github_link'),
					'twitter_link' => $this->request->getPost('twitter_link'),
					'facebook_link' => $this->request->getPost('facebook_link'),
				];
				$profiles->save($data);
				return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
			} else {
				return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
			}
		}
	}
}

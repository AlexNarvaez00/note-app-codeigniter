<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile as ModelsProfile;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;

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

		//Instancias de los Modelos
		$users = new UserModel();
		$profiles = new ModelsProfile();
		//Busqueda del perfil del usuario
		$profile = $profiles->where('idUser', auth()->getUser()->id)->findAll();

		//Cambiarlo por un switch 
		if (strcmp($this->request->getPost('type-informacion'), 'personal') == 0) {
			//Variables de validaciones.
			$profilesPersonalValidate = $this->validate('profiles_personal');
			$rulesUser =  $this->getValidationRules();
			$userInfoValidate = $this->validate($rulesUser);
			$passwordValidate = $this->validate('userPassword');



			//Datos basicos del perfil
			$dataProfile = [];
			//Recuperamos y pseudo-comprobamos que los datos existan.
			$dataProfile['id'] = $profile[0]['id'];
			$dataProfile['workstation'] = (strcmp($this->request->getPost('workstation'), '') == 0) ?
				$profile[0]['workstation'] : $this->request->getPost('workstation');
			$dataProfile['cellphone'] = (strcmp($this->request->getPost('cellphone'), '') == 0) ?
				$profile[0]['cellphone'] : $this->request->getPost('cellphone');
			//Si los datos son correctos los guardamos.
			if ($profilesPersonalValidate) {
				$profiles->save($dataProfile);
			}

			//Datos de la tabla usuarios
			$dataUser = [];
			//Recuperamos y pseudo-comprobamos que los datos existan.
			if ($userInfoValidate) {
				$dataUser['username'] = (strcmp($this->request->getPost('username'), '') == 0) ?
					auth()->getUser()->username :
					$this->request->getPost('username');
				$user = auth()->getUser();
				$user->fill($dataUser);
				$users->save($user);
			}

			//Datos apra verificar si cambio las contrasenias.
			$dataUser = [];
			if ($passwordValidate && strcmp($this->request->getPost('password'), '') != 0) {
				$dataUser['password'] = $this->request->getPost('password');
				auth()->getUser()->fill($dataUser);
				$users->save(auth()->getUser());
			}
			//Preguntamos si ninguna validacion fallo
			if (!$profilesPersonalValidate | !$userInfoValidate | !$passwordValidate) {
				return redirect()->back()->withInput()->with('errors', $this->validator);
			}
		} elseif (strcmp($this->request->getPost('type-informacion'), 'social') == 0) {
			//Variables de validacion de las URL
			$dataSocial = [];
			$dataSocial['id'] =  $profile[0]['id'];
			$dataSocial['twitter_link'] = (strcmp($this->request->getPost('twitter_link'), '') == 0) ?
				$profile[0]['twitter_link'] :
				$this->request->getPost('twitter_link');

			$dataSocial['facebook_link'] = (strcmp($this->request->getPost('facebook_link'), '') == 0) ?
				$profile[0]['facebook_link'] :
				$this->request->getPost('facebook_link');

			$dataSocial['github_link'] = (strcmp($this->request->getPost('github_link'), '') == 0) ?
				$profile[0]['github_link'] :
				$this->request->getPost('github_link');
			if ($this->validate('profiles_social')) {
				$profiles->save($dataSocial);
			}else{
				return redirect()->back()->withInput()->with('errors',$this->validator);
			}
		}

		return redirect()->to(base_url('profile/' . auth()->getUser()->id . '/edit'));
	}
	//------------------ REGLA COPIADA DE LA VALIDACION
	/**
	 * Returns the rules that should be used for validation.
	 *
	 * @return string[]
	 */
	protected function getValidationRules(): array
	{
		$registrationUsernameRules = array_merge(
			config('AuthSession')->usernameValidationRules,
			['is_unique[users.username]']
		);
		return setting('Validation.registration') ?? [
			'username'         => $registrationUsernameRules,
		];
	}
}

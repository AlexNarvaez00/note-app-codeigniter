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
		$identities = new UserIdentityModel();
		//Busqueda del perfil del usuario
		$profile = $profiles->where('idUser', auth()->getUser()->id)->findAll();

		//Variables de validaciones.
		$profilesPersonalValidate = $this->validate('profiles_personal');
		$rulesUser =  $this->getValidationRules();
		$userInfoValidate = $this->validate($rulesUser);

		//Cambiarlo por un switch 
		if (strcmp($this->request->getPost('type-informacion'), 'personal') == 0) {
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

		} elseif (strcmp($this->request->getPost('type-informacion'), 'social') == 0) {
		}
		//Preguntamos si ninguna validacion fallo
		if(!$profilesPersonalValidate | !$userInfoValidate){
			return redirect()->back()->withInput()->with('errors',$this->validator);
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

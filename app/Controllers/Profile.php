<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile as ModelsProfile;
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
			//Variables de condiciones
			$passwordEmpty = strcmp($this->request->getPost('password'), '') == 0;
			$usernameRequest = $this->request->getPost('username');
			//Variables de validaciones.
			$profilesPersonalValidate = $this->validate('profiles_personal');
			$rulesUser =  $this->getValidationRules();
			$userInfoValidate = (strcmp($usernameRequest, auth()->getUser()->username) == 0) ?
				false :
				$this->validate($rulesUser);
			$passwordValidate = ($passwordEmpty) ?
				false :
				$this->validate('userPassword');
			$imgProfileValidate = (strcmp($this->request->getFile('imgProfile')->getName(), '') == 0) ?
				false :
				$this->validate('imgProfile');

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
			if ($imgProfileValidate) {
				$dataProfile = [];
				$nameFileSend = str_replace(base_url('imgs/'), '', $this->request->getFile('imgProfile')->getName());
				if (strcmp($nameFileSend, $profile[0]['imgProfile']) != 0) {
					//Significa que si cambio el archivo
					//Eliminamos el archivo anterior
					if (is_file('../public/imgs/' . $profile[0]['imgProfile'])) {
						unlink('../public/imgs/' . $profile[0]['imgProfile']);
					}

					//Recuperamos y movemos el archivo	
					$file = $this->request->getFile('imgProfile');
					$fileName = $file->getRandomName();
					$dataProfile['id'] = $profile[0]['id'];
					$dataProfile['imgProfile'] = $fileName;
					$profiles->save($dataProfile);
					$file->move('../public/imgs', $fileName);
				} else {
					//No cambio el archivo
				}

				//$dataProfile['imgProfile'] => 
				//$file = $this->request->getFile('imgProfile');
				//$fileName = $file->getRandomName();

			}

			//Datos de la tabla usuarios
			$dataUser = [];
			if ($userInfoValidate) {
				//Recuperamos y pseudo-comprobamos que los datos existan.
				$dataUser['username'] = (strcmp($usernameRequest, '') == 0) ?
					auth()->getUser()->username :
					$usernameRequest;
				$user = auth()->getUser();
				$user->fill($dataUser);
				$users->save($user);
			}

			//Datos apra verificar si cambio las contrasenias.
			$dataUser = [];
			if ($passwordValidate) {
				$dataUser['password'] = $this->request->getPost('password');
				auth()->getUser()->fill($dataUser);
				$users->save(auth()->getUser());
				auth()->logout();
				return redirect()->to(base_url('login'));
			}
			//Preguntamos si ninguna validacion fallo
			if (!$profilesPersonalValidate | !$userInfoValidate | !$passwordValidate | !$imgProfileValidate) {
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
			} else {
				return redirect()->back()->withInput()->with('errors', $this->validator);
			}
		}

		return redirect()->to(str_replace('index.php/', '', base_url('profile/' . auth()->getUser()->id . '/edit')));
	}
	public function delete($id){
		$users = new UserModel();
		$user = $users->where('id',auth()->getUser()->id)->first();
		//print_r($user->id);
		$users->delete($user->id);
		auth()->logout();
		return redirect()->to(base_url('/login'));
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

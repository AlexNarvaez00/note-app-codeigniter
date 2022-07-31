<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Events\Events;
use CodeIgniter\Shield\Authentication\Authenticators\Session;

/**
 * @author Narvaez Ruiz Alexis 
 * Controlador para registar un usuario
 */
class Register extends BaseController
{
	protected $helpers = ['auth', 'setting'];
	public function __construct()
	{
	}


	public function index()
	{
		if (auth()->loggedIn()) {
			return redirect()->to(base_url('/notes'));
		}
		return view('auth/register');
	}

	/**
	 * Attempts to register the user.
	 */
	public function registerAction()
	{
		if (auth()->loggedIn()) {
			return redirect()->to(config('Auth')->registerRedirect());
		}

		// Check if registration is allowed
		if (!setting('Auth.allowRegistration')) {
			return redirect()->back()->withInput()
				->with('error', lang('Auth.registerDisabled'));
		}

		$users = model(setting('Auth.userProvider'));

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = $this->getValidationRules();

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// Save the user
		$allowedPostFields = array_merge(
			setting('Auth.validFields'),
			setting('Auth.personalFields'),
			['password']
		);
		$user = new User();
		$user->fill($this->request->getPost($allowedPostFields));

		// Workaround for email only registration/login
		if ($user->username === null) {
			$user->username = null;
		}

		try {
			$users->save($user);
			//Intentamos crear el registro del perfil.
			$profiles = new Profile();
			$profiles->save(['idUser' => $users->getInsertID()]);
		} catch (ValidationException $e) {
			return redirect()->back()->withInput()->with('errors', $users->errors());
		}

		// To get the complete user object with ID, we need to get from the database
		$user = $users->findById($users->getInsertID());

		// Add to default group
		$users->addToDefaultGroup($user);

		Events::trigger('register', $user);

		/** @var Session $authenticator */
		$authenticator = auth('session')->getAuthenticator();

		$authenticator->startLogin($user);

		// If an action has been defined for register, start it up.
		$hasAction = $authenticator->startUpAction('register', $user);
		if ($hasAction) {
			return redirect()->to('/');
		}

		// Set the user active
		$authenticator->activateUser($user);

		$authenticator->completeLogin($user);

		// Success!
		return redirect()->to(base_url('/notes'));
	}
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
		$registrationEmailRules = array_merge(
			config('AuthSession')->emailValidationRules,
			['is_unique[auth_identities.secret]']
		);

		return setting('Validation.registration') ?? [
			'username'         => $registrationUsernameRules,
			'email'            => $registrationEmailRules,
			'password'         => 'required|strong_password',
			'password_confirm' => 'required|matches[password]',
		];
	}
}

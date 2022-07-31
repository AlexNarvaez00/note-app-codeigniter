<?php

namespace App\Database\Seeds;

use App\Models\Profile;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Events\Events;

class Test extends Seeder
{
	protected $helpers = ['auth', 'setting'];
	public function run()
	{
		//Facker
		$fakerGenerate = \Faker\Factory::create();

		//Creamos el usuario
		$users = new UserModel();
		$data = [
			'email' => $fakerGenerate->email(),
			'username' => $fakerGenerate->name(),
			'password' => 'admin123456789'
		];
		$user = new User($data);
		$users->save($user);
		//Regresa un objecto del modelo de los usuarios (UserModel)
		$user = $users->findById($users->getInsertID());
		// Add to default group
		$users->addToDefaultGroup($user);

	}
}

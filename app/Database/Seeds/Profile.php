<?php

namespace App\Database\Seeds;

use App\Models\Profile as ModelsProfile;
use CodeIgniter\Database\Seeder;

class Profile extends Seeder
{
	public function run()
	{
		$profilesObj = new ModelsProfile();
		/*$data = [*/
			/*'imgProfile' => "https://images.unsplash.com/photo-1618641986557-1ecd230959aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80",*/
			/*'workstation' => "CEO",*/
			/*'github_link' => "https://www.github.com/",*/
			/*'twitter_link' => null,*/
			/*'facebook_link' => null,*/
			/*'cellphone' => "+ 52 5 951 234 4567",*/
			/*'idUser' => 1*/
		/*];*/
		/*$profilesObj->save($data);*/
		//$profile = $profilesObj->where('idUser','1')->findAll();
		//print_r($profile);
	}
}

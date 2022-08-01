<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;

class UploadFile extends BaseController
{
	public function index()
	{
	}
	public function store($idUser)
	{
		$profiles = new Profile();
		$profile = $profiles->where('idUser',auth()->getUser()->id)->findAll();
		$imgProfile = $this->request->getFile('filepond');
		$imgName = null;
		if ($imgProfile) {
			$imgName = $imgProfile->getRandomName();
			$imgProfile->move('../public/imgs', $imgName);
			$data = [
				'id' => $profile[0]['id'],
				'imgProfile' => $imgName
			];
			$profiles->save($data);
			return true;
		}
		return false;
	}
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profile;
use CodeIgniter\RESTful\ResourceController;

class UploadFile extends ResourceController
{
	protected $helpers = ['auth', 'setting'];
	protected $modelName = 'App\Models\Profile';
	protected $format    = 'json';

	public function index()
	{
	}
	public function store($idUser)
	{
		$profiles = new Profile();
		$profile = $profiles->where('idUser', auth()->getUser()->id)->findAll();
		$imgName = null;
		if ($this->request->getPost('filepond')) {
			if (strcmp($this->request->getFile('filepond')->getName(), $profile[0]['imgProfile']) != 0) {
				$imgProfile = $this->request->getFile('filepond');
				$imgProfile->move('../public/imgs', $imgName);
				$imgName = $imgProfile->getRandomName();
				$data = [
					'id' => $profile[0]['id'],
					'imgProfile' => $imgName
				];
				$profiles->save($data);
				return  $this->respond([
					'status' => 'change OK'
				]);
			}
			return $this->respond([
				'status' => 'not change'
			]);
		}
		return $this->respond([
			'error' => 'Not working'
		]);
	}
}

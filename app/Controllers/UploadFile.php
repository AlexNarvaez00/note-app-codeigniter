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

	public function getResources($idUser)
	{
		$profiles = new Profile();
		$profile = $profiles->where('idUser', $idUser)->first();
		return $this->respond([
			'value' => base_url('imgs') . '/' . $profile['imgProfile']
		]);
	}
	public function store($idUser)
	{
		$profiles = new Profile();
		$profile = $profiles->where('idUser', $idUser)->findAll();
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
	public function delete($idUser = null)
	{
		$profiles = new Profile();
		$profile = $profiles->where('idUser', $idUser)->findAll();
		unlink('../public/imgs/' . $profile[0]['imgProfile']);
		return $this->respond([
			'status' => 'DELETED'
		]);
	}
}

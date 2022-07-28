<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Notes as ModelsNotes;
use Coolpraz\PhpBlade\PhpBlade;

/**
 *@author Narvaez Ruiz Alexis
 *  
 * Nota: Las validaciones por comomdidad se escriben en el archovo de 
 * app/Config/Validation.php
 */
class Notes extends BaseController
{
	//Helper para iniciar sesion
	protected $helpers = ['auth', 'setting'];
	//Variables de la vista
	private $views;
	private $cache;
	private $bladeObj;
	public function __construct()
	{
		$this->views = __DIR__ . '/../Views';
		$this->cache = __DIR__ . '/../../vendor/cache';
		$this->bladeObj = new PhpBlade($this->views, $this->cache);
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
					'name'  => 'home',
					'active' => true
				]
			];
			$data['user'] = [ 'username' => auth()->getUser()->username]; 
			//Creamos un objeto del modelo
			$notes = new ModelsNotes();
			//Paginamos los resultados
			$data['notes'] = $notes->findAll();
			return $this->bladeObj->view()->make('notes.home', $data)->render();
		} else {
			return redirect()->to('/login');
		}
	}
	/**
	 * Despliega la vista para solo mostrar informacion 
	 */
	public function show($id)
	{
		if (auth()->loggedIn()) {

			//Este areglo de usa para marcar en donde esta parada la vista
			$data['indexList'] = [
				[
					'name' => 'Notes',
					'link' => '/note'
				],
				[
					'name'  => $id,
					'active' => true
				]
			];
				$data['user'] = [ 'username' => auth()->getUser()->username];
			$notes = new ModelsNotes();
			$note = $notes->find($id);
			if ($note) {
				$data['note'] = $note;
				return $this->bladeObj->view()->make('notes.show', $data)->render();
			}
		} else {
			return redirect()->to('/login');
		}
	}
	/**
	 * Muestra la vista para agregar un nuevo registro
	 */
	public function new()
	{
		if (auth()->loggedIn()) {
			//Este areglo de usa para marcar en donde esta parada la vista
			$data['indexList'] = [
				[
					'name' => 'Notes',
					'link' => '/note'
				],
				[
					'name'  => 'add',
					'active' => true
				]
			];
			session();
				$data['user'] = [ 'username' => auth()->getUser()->username];
			$data['validation'] = \Config\Services::validation();
			return $this->bladeObj->view()->make('notes.add', $data)->render();
		} else {
			return redirect()->to('/login');
		}
	}
	/**
	 * Crea un nuevo registro
	 * */
	public function create()
	{
		if (auth()->loggedIn()) {

			//Objeto Faker para generar ID's xd 
			$fakerObj = \Faker\Factory::create();
			//Objeto del modelo
			$notes = new ModelsNotes();
			//Preguntamos si el metodo es de tipo POST
			if ($this->request->getMethod() == 'post') {
				//Validadmos los datos de la peticion.
				$validations = $this->validate('notes');
				if (!$validations) {
					return redirect()->to(base_url('notes/new'))->withInput();
				}
				//Guardamos los datos en la base de datos 
				$newData = [
					'id' => substr($fakerObj->uuid(), 0, 15),
					'title' => $this->request->getPost('title'),
					'content' => $this->request->getPost('content')
				];
				$notes->save($newData);
				return redirect()->to(base_url('/notes'));
			}
		} else {
			return redirect()->to('/login');
		}
	}
	/**
	 * Muestra la vista con la informacion del registro solicitado
	 */
	public function edit($id)
	{
		if (auth()->loggedIn()) {
			//Este areglo de usa para marcar en donde esta parada la vista
			$data['indexList'] = [
				[
					'name' => 'Notes',
					'link' => '/note'
				],
				[
					'name' => $id,
					'link' => null
				],
				[
					'name'  => 'edit',
					'active' => true
				]
			];
				$data['user'] = [ 'username' => auth()->getUser()->username];
			//Objeto del model
			$notes = new ModelsNotes();
			$data['note'] = $notes->find($id);
			session();
			$data['validation'] = \Config\Services::validation();
			return $this->bladeObj->view()->make('notes.edit', $data)->render();
		} else {
			return redirect()->to('/login');
		}
	}

	public function update($id)
	{
		if (auth()->loggedIn()) {
			//Objeto del model
			$notes = new ModelsNotes();
			if ($this->request->getMethod() == 'put') {
				if (!$this->validate('notes')) {
					return redirect()->to(base_url('notes/' . $id . '/edit'))->withInput();
				}
				$updateData = [
					'id' => $id,
					'title' => $this->request->getPost('title'),
					'content' => $this->request->getPost('content')
				];
				$notes->save($updateData);
				return redirect()->to(base_url('/notes'));
			}
		} else {
			return redirect()->to('/login');
		}
	}
	/**
	 * Nos permite eliminar un elemento de la tabla
	 */
	public function delete($id)
	{
		if (auth()->loggedIn()) {
			//Creamos un objeto del modelo
			$notes = new ModelsNotes();
			$register = $notes->find($id);
			if ($register) {
				$notes->delete($id);
				return $this->response->setJSON([
					'ok' => 'realizado'
				]);
			} else {
				echo 'Erro de borrado';
			}
		} else {
			return redirect()->to('/login');
		}
	}
}

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
                //Creamos un objeto del modelo
                $notes = new ModelsNotes();
                //Paginamos los resultados
                $data['notes'] = $notes->findAll();
                return $this->bladeObj->view()->make('notes.home', $data)->render();
        }
        /**
         * Muestra la vista para agregar un nuevo registro
         */
        public function new()
        {
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
                $data['validation'] = \Config\Services::validation();
                return $this->bladeObj->view()->make('notes.add', $data)->render();
        }
        /**
         * Crea un nuevo registro
         * */
        public function create()
        {
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
                                'name' => $id,
                                'link' => null
                        ],
                        [
                                'name'  => 'edit',
                                'active' => true
                        ]
                ];
                //Objeto del model
                $notes = new ModelsNotes();
                $data['note'] = $notes->find($id);
                session();
                $data['validation'] = \Config\Services::validation();
                return $this->bladeObj->view()->make('notes.edit', $data)->render();
        }

        public function update($id)
        {
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
        }
        /**
         * Nos permite eliminar un elemento de la tabla
         */
        public function delete($id)
        {
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
        }
}

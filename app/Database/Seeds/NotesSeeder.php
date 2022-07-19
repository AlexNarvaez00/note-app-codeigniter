<?php

namespace App\Database\Seeds;

use App\Models\Notes as NotesModel;
use CodeIgniter\Database\Seeder;

class NotesSeeder extends Seeder
{
	public function run()
	{
		//Creamos un objeto del modelo
		$notesObj = new NotesModel();
		$notesObj->insert([
			'id' => 'NOTE-1',
			'title' => 'Titulo primero',
			'content' => 'Voy a escribir los versos mas triste esta noche ....'
		]);
	}
}

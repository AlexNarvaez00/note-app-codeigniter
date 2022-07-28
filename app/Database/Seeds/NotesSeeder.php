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
		//Creamos una instancia de Faker
		$fakerObj = \Faker\Factory::create();
		for ($i = 0; $i < 100; $i++) {
			$notesObj->insert([
				'id' => 'NOTE-' . $i,
				'title' => $fakerObj->sentence(15),
				'content' => $fakerObj->paragraph()
			]);
		}
	}
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

/**
 * @author Narvaez Ruiz Alexis
 * Tabla de Notas
 */
class Notes extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'VARCHAR',
				'null' => false,
				'constraint' => 30
			],
			'title' => [
				'type' => 'VARCHAR',
				'null' => false,
				'constraint' => 120
			],
			'content' => [
				'type' => 'TEXT',
				'null' => false
			],
			'created_at' => [
				'type'    => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP')
			],
			'updated_at' => [
				'type' => 'TIMESTAMP',
				'null' => true
			],
			'deleted_at' => [
				'type' => 'timestamp',
				'null' => true
			]
		]);
		//Creamos la tabla en la base de datos
		$this->forge->createTable('notes');
	}

	public function down()
	{
		//Borramos la tabla de la base de datos
		$this->forge->dropTable('notes', true, true);
	}
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

/**
 * @author Narvaez Ruiz Alexis
 * Tabla de usuarios
 */
class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'VARCHAR',
				'null' => false,
				'constraint' => 30
			],
			'name' => [
				'type' => 'VARCHAR',
				'null' => false,
				'constraint' => 100
			],
			'password' => [
				'type' => 'TEXT',
				'null' => false
			],
			'created_at' => [
				'type'    => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP'),
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
		$this->forge->createTable('users');
	}

	public function down()
	{
		//Borramos la tabla de la base de datos
		$this->forge->dropTable('users', true, true);
	}
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profile extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
			],
			'imgProfile' => [
				'type' => 'text',
				'null' => true,
			],
			'workstation' =>[
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => true
			],
			'updated_at' => [
				'type' => 'TIMESTAMP',
				'null' => true
			],
			'github_link' => [
				'type' => 'TEXT',
				'null' => true
			],
			'twitter_link' => [
				'type' => 'TEXT',
				'null' => true
			],
			'facebook_link' => [
				'type' => 'VARCHAR',
				'null' => true
			],
			'cellphone' => [
				'type' => 'VARCHAR',
				'constraint' => 25,
				'null' => true
			] 
		]);
		$this->forge->createTable('profile');
	}

	public function down()
	{
		$this->forge->dropTable('profile');
	}
}

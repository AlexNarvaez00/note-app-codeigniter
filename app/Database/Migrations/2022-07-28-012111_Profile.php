<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Profile extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'imgProfile' => [
				'type' => 'text',
				'null' => true,
			],
			'workstation' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
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
				'type' => 'TEXT',
				'null' => true
			],
			'cellphone' => [
				'type' => 'VARCHAR',
				'constraint' => 25,
				'null' => true
			],
			'idUser' => [
				'type' => 'int', 
				'constraint' => 11, 
				'unsigned' => true, 
			],
			'created_at' => [
				'type'    => 'TIMESTAMP',
				'default' => new RawSql('CURRENT_TIMESTAMP')
			],
			'updated_at' => [
				'type' => 'TIMESTAMP',
				'null' => true
			],
		]);
		$this->forge->addPrimaryKey('id');
		//$this->forge->addForeignKey('user_id', 'users', 'id','', 'CASCADE');
		$this->forge->createTable('profile',true);
	}

	public function down()
	{
		$this->forge->dropTable('profile');
	}
}

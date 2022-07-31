<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Test extends Migration
{
    public function up()
    {
	    $this->forge->addField(['id'=>[
		    'type' => 'INT'
	    ]]);
	    $this->forge->createTable('test');
    }

    public function down()
    {
        //
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Profile extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'profile';
	protected $primaryKey       = 'id';
	protected $useAutoIncrement = true;
	protected $insertID         = 0;
	protected $returnType       = 'array';
	protected $useSoftDeletes   = false;
	protected $protectFields    = true;
	protected $allowedFields    = ['id', 'imgProfile', 'workstation', 'updated_at', 'github_link', 'twitter_link', 'facebook_link', 'cellphone', 'idUser'];

	// Dates
	protected $useTimestamps = true;
	protected $dateFormat    = 'datetime';
	//protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	//protected $deletedField  = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks = true;
	protected $beforeInsert   = [];
	protected $afterInsert    = [];
	protected $beforeUpdate   = [];
	protected $afterUpdate    = [];
	protected $beforeFind     = [];
	protected $afterFind      = [];
	protected $beforeDelete   = [];
	protected $afterDelete    = [];
}

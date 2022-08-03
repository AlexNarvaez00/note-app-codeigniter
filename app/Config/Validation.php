<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $notes = [
		'title' => 'required|min_length[3]|max_length[120]',
		'content' => 'required|min_length[3]|max_length[300]'
	];
	public $profiles_personal = [
		//'imgProfile' => 'permit_empty|uploaded[uploaded]|max_size[6,144]|is_image[imgProfile]|ext_in[imgProfile,png,jpg,jpeg]',
		'workstation' => 'permit_empty|alpha_space|min_length[3]|max_length[30]',
		'cellphone' => 'required|permit_empty|numeric'
	];
	public $imgProfile = [
		'imgProfile' => 'is_image[imgProfile]|mime_in[imgProfile,image/jpg,image/jpeg,image/png,image/webp]|max_size[imgProfile,4096]'
	];
	public $profiles_social = [
		'github_link' => 'permit_empty|valid_url',
		'twitter_link' => 'permit_empty|valid_url',
		'facebook_link' => 'permit_empty|valid_url',
	];
	public $userPassword = [
		'password'         => 'strong_password',
		'password_confirm' => 'matches[password]',
	];
}

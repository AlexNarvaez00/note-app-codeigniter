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
		'imgProfile' => 'permit_empty|uploaded[uploaded]|max_size[6,144]|is_image[imgProfile]|ext_in[imgProfile,png,jpg,jpeg]',
		'filepond' => 'permit_empty|uploaded[uploaded]|max_size[6,144]|is_image[imgProfile]|ext_in[imgProfile,png,jpg,jpeg]',
		'workstation' => 'permit_empty|alpha_space',
		//'github_link' => 'permit_empty',
		//'twitter_link' => 'permit_empty',
		//'facebook_link' => 'permit_empty',
		'cellphone' => 'permit_empty|numeric'
	];
	public $profiles_social = [
		//'imgProfile' => 'permit_empty|uploaded[uploaded]|max_size[6,144]|is_image[imgProfile]|ext_in[imgProfile,png,jpg,jpeg]',
		//'workstation' => 'permit_empty|alpha_space',
		'github_link' => 'permit_empty|valid_url',
		'twitter_link' => 'permit_empty|valid_url',
		'facebook_link' => 'permit_empty|valid_url',
		//'cellphone' => 'permit_empty|numeric'
	];
}

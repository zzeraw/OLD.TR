<?php
class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		// Load stuff
		$this->load->model('section_model');
		$this->load->model('main_model');
		$this->load->model('group_model');
		$this->load->model('collection_model');

		// Fetch navigation
		$this->data['horizontal_menu'] = $this->section_model->get();
		$this->data['vertical_menu']['collections'] = $this->collection_model->get();
		$this->data['vertical_menu']['groups'] = $this->group_model->get();

		$this->data['meta_title'] = config_item('site_name');
	}
}
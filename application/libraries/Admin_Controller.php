<?php
class Admin_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->data['meta_title'] = 'Панель управления';
		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_model');

		// Login check
		$exception_uris = array(
			'admin/user/login',
			'admin/user/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_model->loggedin() == FALSE) {
				redirect('admin/user/login');
			}
		}
	}

    public function _unique_slug() {
        $this->load->model('main_model');

        if ($this->main_model->checkUniqueSlug($this->input->post('slug'))) {
            return TRUE;
        } else {
        	$this->form_validation->set_message('_unique_slug', '%s должно быть уникальным!');
            return FALSE;
        }
    }

}
<?php
class User extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		// Fetch all users
		$this->data['users'] = $this->user_model->get();

		// Load view
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a user or set a new one
		if ($id) {
			$this->data['user'] = $this->user_model->get($id);
			count($this->data['user']) || $this->data['errors'][] = 'Пользователь не найден';
		}
		else {
			$this->data['user'] = $this->user_model->get_new();
		}

		// Set up the form
		$rules = $this->user_model->rules_admin;
		$id || $rules['password']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->user_model->array_from_post(array('username', 'password'));
			$data['password'] = $this->user_model->hash($data['password']);
			$this->user_model->save($data, $id);
			redirect('admin/user');
		}

		// Load the view
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function delete ($id)
	{
		$this->user_model->delete($id);
		redirect('admin/user');
	}

	public function login ()
	{
		// Redirect a user if he's already logged in
		$dashboard = 'admin/dashboard';
		$this->user_model->loggedin() == FALSE || redirect($dashboard);

		// Set form
		$rules = $this->user_model->rules;
		$this->form_validation->set_rules($rules);

		// Process form
		if ($this->form_validation->run() == TRUE) {
			// We can login and redirect
			if ($this->user_model->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', 'Неверное сочетание имени пользователя и пароля!');
				redirect('admin/user/login', 'refresh');
			}
		}

		// Load view
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/_layout_modal', $this->data);
	}

	public function logout ()
	{
		$this->user_model->logout();
		redirect('admin/user/login');
	}

	public function _unique_username ($str)
	{
		// Do NOT validate if username already exists
		// UNLESS it's the username for the current user

		$id = $this->uri->segment(4);
		$this->db->where('username', $this->input->post('username'));
		!$id || $this->db->where('id !=', $id);
		$user = $this->user_model->get();

		if (count($user)) {
			$this->form_validation->set_message('_unique_username', '%s должно быть уникальным!');
			return FALSE;
		}

		return TRUE;
	}
}
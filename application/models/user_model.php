<?php
class User_Model extends MY_Model
{

	protected $_table_name = 'users';
	protected $_order_by = 'username';
	public $rules = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Имя пользователя',
			'rules' => 'trim|required|xss_clean'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Пароль',
			'rules' => 'trim|required'
		)
	);
	public $rules_admin = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Email',
			'rules' => 'trim|required|callback__unique_username|xss_clean'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm',
			'label' => 'Confirm password',
			'rules' => 'trim|matches[password]'
		),
	);

	function __construct ()
	{
		parent::__construct();
	}

	public function login ()
	{
		$user = $this->get_by(array(
			'username' => $this->input->post('username'),
			'password' => $this->hash($this->input->post('password')),
		), TRUE);

		if (count($user)) {
			// Log in user
			$data = array(
				'username' => $user->username,
				'id' => $user->id,
				'loggedin' => TRUE,
			);
			$this->session->set_userdata($data);
		}
	}

	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}

	public function get_new(){
		$user = new stdClass();
		$user->username = '';
		$user->password = '';
		return $user;
	}

	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}
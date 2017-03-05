<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->library('session');

		if($this->session->userdata('_user')) redirect();

		$this->load->view('pages/login-page');
	}

	public function login()
	{
		//print_r($this->input->post());exit;
		$_post = $this->input->post();
		if ($_post['login'] && $_post['password'])
		{
			$this->load->model('User');
			$_user = $this->User->getByLoginData(array('login' => $_post['login'], 'password' => $_post['password']));
			if ($_user)
			{
				$this->load->library('session');
				$this->session->set_userdata('_user', $_user);
				redirect();
			}
		}
		$_vars = array();
		$this->load->view('pages/login-page', $_vars);
	}

	public function logout()
	{
		$this->load->library('session');
		$this->session->unset_userdata('_user');
		redirect('auth/');
	}

	public function register()
	{
		$_post = $this->input->post();
		if($_post && $_post['password'] === $_post['password-repeated'])
		{
			$this->load->model('User');
			if($_user = $this->User->create(array('login' => $_post['login'], 'password' => $_post['password'])))
			{
				$this->load->library('session');
				$this->session->set_userdata('_user', $_user);
				redirect();
			}
		}
		$_vars = array();
		$this->load->view('pages/register-page', $_vars);
	}
}
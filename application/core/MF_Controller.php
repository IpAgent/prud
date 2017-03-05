<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MF_Controller extends CI_Controller
{
	protected $userIdentity = null;
	protected $layout = 'default';

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->library('json');
		$this->load->model('User');

		$_var = $this->session->userdata('_user');

		if(empty($_var))
		{
			$this->load->helper('url');
			redirect('auth/');
		}
		$this->userIdentity = (object)$_var;
	}

	protected function render($view, $data = array())
	{
		$this->load->helper('url');
		$this->load->helper('html');

		$_data = array();
		$_l = 'layouts/' . $this->layout;

		$_data['content'] = $this->load->view($view, $data, true);
		$_data['header'] = $this->load->view($_l . '/block/header', array(), true);
		$_data['footer'] = $this->load->view($_l . '/block/footer', array(), true);

		return $this->load->view($_l.'/index', $_data);
	}

	protected function renderT($view, $data = array())
	{
		return $this->load->view($view, $data, true);
	}

	protected function pageResponse($template, $data, $useLayout = true)
	{
		if ($this->input->is_ajax_request())
		{
			return $this->json->sendSuccess($this->renderT($template, $data));
		}
		if(!$useLayout)
		{
			return $this->render($template, $data);
		}
		return $this->load->view($template, $data);
	}

	protected function jsonResponse($data)
	{
		if ($this->input->is_ajax_request())
		{
			return $this->json->sendSuccess($data);
		}
		return $data;
	}

	protected function errorResponse($msg)
	{
		if($this->input->is_ajax_request())
		{
			$this->json->addMessage($msg, 'error');
			$this->json->sendFailure();
		}
		return $msg;
	}
}

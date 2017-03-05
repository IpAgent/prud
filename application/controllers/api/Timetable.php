<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable extends MF_Controller
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

	public function all()
	{
		$this->load->model('Timetable_model', 'timetable');
		$_vars = array();

		$_vars['list'] = $this->timetable->getAll($this->userIdentity->user_id);
		$this->pageResponse('timetable/list', $_vars);
	}

	public function create()
	{
		$_values = $this->input->post();

		$this->load->model('Timetable_model', 'timetable');

		$_id = $this->timetable->create(['name' => $_values['name'],
									'description' => $_values['description'],
									'user_id' => $this->userIdentity->user_id]);
		$this->jsonResponse(['id' => $_id]);
	}

	public function remove()
	{
		$_values = $this->input->get();
		$this->load->model('Timetable_model', 'timetable');
		$this->timetable->remove($_values['id']);
		$this->jsonResponse([]);
	}

	public function edit()
	{
		$_values = $this->input->post();
		$this->load->model('Timetable_model', 'timetable');
		$this->timetable->update($_values['id'], ['name' => $_values['name'], 'description' => $_values['description']]);
		$this->jsonResponse([]);
	}

	public function form()
	{
		$_params = $this->input->get();
		switch($_params['type'])
		{
			case 'create':
				$this->pageResponse('timetable/create', array());
				break;
			case 'edit':
				$this->load->model('Timetable_model', 'timetable');
				$_arrs = [];
				$_arrs['data'] = $this->timetable->getById($_params['id']);
				$this->pageResponse('timetable/edit', $_arrs);
				break;
		}
	}
}
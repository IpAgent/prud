<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends MF_Controller
{
	public function index($idx = 1)
	{
		/*$_beginDate = new DateTime("2016-9-1");
		$_beginWeek = $_beginDate->format("W");
		$_currentDate = new DateTime("NOW");
		$_currentWeek = $_currentDate->format("W");

		if($idx != 1 || $idx != 2)
		{
			$idx = 1;
			if($_beginWeek % 2 !== $_currentWeek % 2)
			{
				$idx = 2;
			}
		}
		print_r($idx);*/
		/*if($idx != 1 && $idx != 2)
		{
			$idx = 1;
		}
		$this->load->model('Timetable');
		$_vars = array();
		$_vars['data'] = $this->Timetable->getByWeek(1, $idx);
		$_vars['idx'] = $idx;
		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('timetable/index', $_vars, true));
		}
		$this->render('timetable/index', $_vars);*/
		$this->load->helper('url');
		redirect('editor/showTimetableForView');
	}

	public function details($id)
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('Timetable');
			$_vars = array();
			$_vars['data'] = $this->Timetable->getLesson($id);
			$this->json->sendSuccess($this->load->view('timetable/details', $_vars, true));
		}
		$this->json->sendFailure();
	}

	public function edit()
	{
		$_vars = array();
		if($_post = $this->input->post())
		{

		}
		$this->render('timetable/edit', $_vars);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends MF_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	public function index($id = 0)
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

	public function edit($id, $date, $position, $dateS, $dateF, $lessonId)
	{
		$this->load->model('Lesson_model', 'Lesson');
		if($_post = $this->input->post())
		{
			$_vars = array();
			$data = array();
			$data['comment'] = $_post['comment'];

			$this->Lesson->update($lessonId, $data);

			$_vars['employ'] = $this->Lesson->getLessonsByTimetableIdAndBetweenDates($id,$dateS, $dateF);
			$_vars['date']['startWeek'] = $dateS;
			$_vars['date']['finishWeek'] = $dateF;
			$_vars['date']['id'] = $id;
			if($this->input->is_ajax_request())
			{
				$this->load->helper('url');
				$this->json->sendSuccess($this->load->view('editor/LessonsView', $_vars, true));
			}
			$this->render('editor/LessonsView', $_vars);
			/*return redirect('editor/LessonsView');
			//$this->json->sendSuccess();
			//print_r($_post);exit;*/
		}
	}

	public function create($id = 0)
	{
		$_vars = array();
		if($_post = $this->input->post())
		{
			print_r($_post);exit;
		}

		if($this->input->is_ajax_request())
		{
			$this->json->sendSuccess($this->load->view('editor/lesson', $_vars, true));
		}
	}
}
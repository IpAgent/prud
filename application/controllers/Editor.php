<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editor extends MF_Controller
{

	public function showLessonForEditSave($idEmploy, $idTimetable)
	{
		if($_post = $this->input->post())
		{
			$this->load->model('timetable_model');
			$data = array();
			$datal = array();
			$groups = explode(":", $_post['groups']);
			$data['name'] = $_post['name'];
			if ($_post['type'] == "Лекция")
				$datal['type'] = "lecture";
			else
				$datal['type'] = "practical";

			$datal['short_description'] = $_post['short_description'];
			$this->timetable_model->updateEmploy($idEmploy, $data, $datal,$groups);
			$this->showLessonEdit($idTimetable,1);
		}
	}

	public function showLessonForEdit($idEmploy, $idTimetable)
	{
		$this->load->model('timetable_model');
		$varray = array();
		$varray['data'] =  $this->timetable_model->getEmploy($idEmploy);
		$varray['groups'] = $this->timetable_model->getAllGroups();
				$varray['idTimetable'] = $idTimetable;
		$varray['idEmploy'] = $idEmploy;
		$this->load->helper('url');
		$this->json->sendSuccess($this->load->view('editor/LessonViewEdit', $varray, true));
	}

	public function showLessonEdit($idTimetable, $teg = 0)
	{
		$this->load->model('timetable_model');
		$varray = array();
		$varray['data'] = $this->timetable_model->getLessonForEdit($idTimetable);

		$this->load->helper('url');
		if ($teg == 0)
		$this->json->sendSuccess($this->load->view('editor/LessonsViewEdit', $varray, true));
		else
		$this->render('editor/LessonsViewEdit', $varray);
	}

	public function deleteTimetable($idTimetable)
	{
		$this->load->model('timetable_model');
		$this->timetable_model->deleteTimetable($idTimetable);
		$this->showTimetableForEdit();

	}

	public function AddNewTimetable()
	{
		if($this->input->is_ajax_request())
		{
			$vars = array();
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/timetableSingle', $vars, true));
		}

		if($_post = $this->input->post())
		{
			$this->load->model('timetable_model');
			$data = array();
			$data['user_id'] = $this->userIdentity->user_id;
			$data['name'] = $_post['name'];
			$this->timetable_model->addNewTimetable($data);
			$this->showTimetableForEdit();
		}


	}
	public function changeNameTimetable($idTametable)
	{
		$vars = array();

		$this->load->model('timetable_model');

		if($this->input->is_ajax_request())
		{
			$vars['data'] = $this->timetable_model->getSingleTimetable($idTametable);
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/timetableSingle', $vars, true));
		}

		if($_post = $this->input->post())
		{
			$this->timetable_model->updateNameTimetable($idTametable,$_post);
			$this->showTimetableForEdit();
		}

	}

	public function showLesson($_id_tametable, $_date, $position, $dateS, $dateF, $lessonId)
	{
		$_vars = array();
		$position++;

		$this->load->model('lesson_model');
		$_vars['lesson'] = $this->lesson_model->getLesson($_id_tametable, $_date, $position, $lessonId);
		$_vars['id'] = $_id_tametable;
		$_vars['date'] = $_date;
		$_vars['position'] = $position;
		$_vars['dateS'] = $dateS;
		$_vars['dateF'] = $dateF;
		$_vars['lessonId'] = $lessonId;

		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/Lesson', $_vars, true));
		}
		/*$this->render('editor/Lesson', $_vars);*/


	}


	public function showLessonsForView($_id)
	{
		$_vars = array();
		$this->load->model('lesson_model');
		/*$date = substr($_vars['employ'][0]['execute_date'], 0 ,strpos($_vars['employ'][0]['execute_date']," "));*/
		$_vars['date']['startWeek'] = date('Y-m-d', strtotime('Mon this week'));

		$_vars['date']['finishWeek'] = date('Y-m-d', strtotime('Sun this week'));

		$_vars['date']['id'] = $_id;

		$_vars['employ'] = $this->lesson_model->getLessonsByTimetableIdAndBetweenDates($_id, $_vars['date']['startWeek'], $_vars['date']['finishWeek']);

		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/LessonsView', $_vars, true));
		}
		$this->render('editor/LessonsView', $_vars);
	}

	public function showLessonsWeekBefore( $start, $finish, $id = 1)
	{
		$this->load->model('lesson_model');
		$_vars = array();

		$dateStart = new DateTime($start);
		date_sub($dateStart, date_interval_create_from_date_string('7 days'));
		$start =  $dateStart->format('Y-m-d');

		$_vars['date']['startWeek'] = $start;
		$_vars['date']['id'] = $id;
		$dateFinish = new DateTime($finish);
		date_sub($dateFinish, date_interval_create_from_date_string('7 days'));
		$finish =  $dateFinish->format('Y-m-d');

		$_vars['date']['finishWeek'] = $finish;


		$_vars['employ'] = $this->lesson_model->getLessonsByTimetableIdAndBetweenDates($id, $_vars['date']['startWeek'], $_vars['date']['finishWeek']);


		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/LessonsView', $_vars, true));
		}
		$this->render('editor/LessonsView', $_vars);
	}

	public function showLessonsWeekAfter( $start, $finish, $id = 1)
	{
		$this->load->model('lesson_model');
		$_vars = array();

		$dateStart = new DateTime($start);
		date_add($dateStart, date_interval_create_from_date_string('7 days'));
		$start =  $dateStart->format('Y-m-d');

		$_vars['date']['startWeek'] = $start;
		$_vars['date']['id'] = $id;
		$dateFinish = new DateTime($finish);
		date_add($dateFinish, date_interval_create_from_date_string('7 days'));
		$finish =  $dateFinish->format('Y-m-d');

		$_vars['date']['finishWeek'] = $finish;


		$_vars['employ'] = $this->lesson_model->getLessonsByTimetableIdAndBetweenDates($id, $_vars['date']['startWeek'], $_vars['date']['finishWeek']);
		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/LessonsView', $_vars, true));
		}
		$this->render('editor/LessonsView', $_vars);
	}

	public function showTimetableForView()
	{
		$this->load->model('Timetable_model');
		$_vars = array();
		$_vars['data'] = $this->Timetable_model->getTimetableByUserId($this->userIdentity->user_id);
		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/timetableViewForView', $_vars, true));
		}

		$this->render('editor/timetableViewForView', $_vars);
	}

	public function showTimetableForEdit()
	{
		$this->load->model('Timetable_model');
		$_vars = array();
		$_vars['data'] = $this->Timetable_model->getTimetableByUserId($this->userIdentity->user_id);

		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/timetableViewForEdit', $_vars, true));
		}

		$this->render('editor/timetableViewForEdit', $_vars);
	}

	public function timetable($idx = 1)
	{


		if($idx != 1 && $idx != 2)
		{
			$idx = 1;
		}
		$this->load->model('Timetable_model');
		$_vars = array();
		$_vars['data'] = $this->Timetable_model->getByWeek(1, $idx);
		$_vars['idx'] = $idx;
		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/timetable', $_vars, true));
		}
		$this->render('editor/timetable', $_vars);
	}

	/*public function ShowTestView($group_id = 1, $employ_id = 1271)
	{

		$this->load->model('Mark_model');
		$_vars = array();

		$_vars['marks'] = $this->Mark_model->getMarksOnEmploy($group_id, $employ_id);
		$_vars['lesson'] = $this->Mark_model->getAllLesson($employ_id);
		$_vars['students'] = $this->Mark_model->getGroup($group_id);

		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/TestView', $_vars, true));
		}
		$this->render('editor/TestView', $_vars);

	}*/

	public function ShowGroupMarks($group_id, $employ_id, $sub)
	{

		$this->load->model('Mark_model');
		$_vars = array();

		if ($sub != 0 ) {
			$_vars['marks'] = $this->Mark_model->getSubMarksOnEmploy($group_id, $employ_id, $sub);
			$_vars['lesson'] = $this->Mark_model->getAllLesson($employ_id);
			$_vars['students'] = $this->Mark_model->getSubGroup($group_id, $sub);
		}
		else {
			$_vars['marks'] = $this->Mark_model->getMarksOnEmploy($group_id, $employ_id);
			$_vars['lesson'] = $this->Mark_model->getAllLesson($employ_id);
			$_vars['students'] = $this->Mark_model->getGroup($group_id);
		}
		if ($_vars['lesson']['0']['type'] == 'lecture'){
			if ($this->input->is_ajax_request()) {
				$this->load->helper('url');
				$this->json->sendSuccess($this->load->view('editor/ShowStudentsMarksOnEmployLecture', $_vars, true));
			}
			$this->render('editor/ShowStudentsMarksOnEmployLecture', $_vars);
		}else {
			if ($this->input->is_ajax_request()) {
				$this->load->helper('url');
				$this->json->sendSuccess($this->load->view('editor/ShowStudentsMarksOnEmployPractical', $_vars, true));
			}
			$this->render('editor/ShowStudentsMarksOnEmployPractical', $_vars);
		}

	}

	public function EditorGroup($group){

		$this->load->model('Mark_model');
		$_vars = array();
		$_vars['group'] = $this->Mark_model->getGroup($group);
		if($this->input->is_ajax_request())
		{
			$this->load->helper('url');
			$this->json->sendSuccess($this->load->view('editor/GroupEditor', $_vars, true));
		}
		$this->render('editor/GroupEditor', $_vars);
	}


}
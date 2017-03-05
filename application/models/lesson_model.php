<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_model extends MF_Model
{
		public function getById($id, $type = 'array')
	{
		return $this->db->select('*')
			->where('lesson_id', $id)
			->get('lesson')
			->result_array();
	}

	public function update($lessonId, $data)
	{
		$das = array();
		/*$das = $this->db->join('lesson', 'employ.employ_id = lesson.employ_id')
			->where('execute_date = ', $date)
			->where('position = ', $position)
			->get('lesson')
			->result_array();
		print_r($das);*/
		/*print_r($date . ' ');
		print_r($position . ' ');
		print_r($data);*/

		return $this->db
			->where('lesson_id = ', $lessonId)
			->update('lesson', $data);
	}

	public function getGroupsOnEmploy($employ_id)
	{
		return $this->db->select("*")
			->from('employ_group')
			->join('group.group_id = employ_group.group_id')
			->where('employ_group.employ_id', $employ_id)
			->get()
			->result_array();
	}

	public function getLessonsByTimetableId($id,$type = 'array')
	{

		return $this->db->select("*")
			->join('lesson', 'employ.employ_id = lesson.employ_id')
			->where('timetable_id',$id)
			->get('employ')
			->result_array();
	}
	public function getLessonsByTimetableIdAndBetweenDates($id,$start, $finish,$type = 'array')
	{
		return $this->db->select("*, g.name as gname, e.name as name, e.group_id as sub")
			->from('employ as e')
			->join('lesson', 'e.employ_id = lesson.employ_id')
			->join('employ_group','employ_group.employ_id = e.employ_id')
			->join('group as g','g.group_id = employ_group.group_id')
			->where('timetable_id',$id)
			->where('execute_date >= ', $start)
			->where('execute_date <= ', $finish)
			->get()
			->result_array();
	}

	public function getLesson($_id_timetable, $_date, $_position, $lessonId)
	{
		$data = array();
		$data = $this->db->select("*, g.name as gname, e.name as name, e.group_id as sub")
			->from('employ as e')
			->join('lesson', 'e.employ_id = lesson.employ_id')
			->join('employ_group','employ_group.employ_id = e.employ_id')
			->join('group as g','g.group_id = employ_group.group_id')
			->where('e.timetable_id',$_id_timetable)
			->where('lesson.execute_date = ', $_date)
			->where('lesson.position = ', $_position)
			->where('lesson.lesson_id = ', $lessonId)

			->get()
			->result_array();
		return $data;

	}

	public function Test($id){
		$data = $this->db->select("*")
			->from('group')
			->join('student', 'student.group_id = group.group_id')
			->where('group.group_id', $id)
			->get()
			->result_array();
		return $data;
	}
}

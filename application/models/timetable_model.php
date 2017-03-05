<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable_model extends MF_Model
{
	public function saveEmployGroups()
	{

	}

	public function getAllGroups()
	{
		return $this->db->select("*")
		->get('group')
		->result_array();
	}

	public function updateEmploy($idEmploy,$data, $datal, $groups)
	{
		$groupsIn = array();
		$indexGroupIn = 0;

		foreach ($groups as $valuegr ) {
			$groupTemp = $this->db->select("*")
				->where('name',$valuegr)
				->get('group')
				->result_array();
			if (isset($groupTemp[0]))
			{
				$groupsIn[$indexGroupIn]['name'] = $valuegr;
				$groupsIn[$indexGroupIn]['group_id'] = $groupTemp[0]['group_id'];
				$indexGroupIn++;
			}
		}

		$varray['groupsOnEmploy'] = $this->db->select("*")
			->join('group', 'group.group_id = employ_group.group_id')
			->where('employ_id',$idEmploy)
			->get('employ_group')
			->result_array();
		if (isset ($varray['groupsOnEmploy'][0]))
		{
			if (isset ($groups[0]))
			{
				foreach ($groupsIn as $grvalue ) {
					$flag = 0;
					foreach ($varray['groupsOnEmploy'] as $value ) {
						if ($grvalue['name'] == $value['name'])
						{
							$flag = 1;
							break;
						}
					}
					if ($flag == 0)
					{
						$arra['employ_id'] = $idEmploy;
						$arra['group_id'] = $grvalue['group_id'];
						$this->db->insert('employ_group', $arra);
					}
				}
			}
		}
		else
		{
			foreach ($groupsIn as $grvalue ) {
					$arra['employ_id'] = $idEmploy;
					$arra['group_id'] = $grvalue['group_id'];
					$this->db->insert('employ_group', $arra);
			}
		}
		$this->db->where('employ_id', $idEmploy)->update('employ', $data);
		return $this->db->where('employ_id', $idEmploy)->update('lesson', $datal);
	}

	public function getEmploy($idEmploy)
	{
		$varray = array();
		$varray['employ'] = $this->db->select("*")
			->where('employ_id',$idEmploy)
			->get('employ')
			->result_array();
		$varray['lesson'] = $this->db->select("*")
			->where('employ_id',$idEmploy)
			->get('lesson')
			->result_array();
		$varray['groupsOnEmploy'] = $this->db->select("*")
			->join('group', 'group.group_id = employ_group.group_id')
			->where('employ_id',$idEmploy)
			->get('employ_group')
			->result_array();

		return $varray;
	}

	public function getLessonForEdit($idTimetable)
	{
		$data = array();


		$data = $this->db->select("*")
			->where('timetable_id',$idTimetable)
			->get('employ')
			->result_array();
		$a = 0;
		foreach ($data as $value ) {
			$tempData = array();
			$tempData = $this->db->select("*")
				->where('employ_id',$value['employ_id'])
				->get('lesson')
				->result_array();

			$data[$a]['short_description'] = $tempData[0]['short_description'];


			$a++;

		}
		return $data;
		/*return $this->db->select("*")
			->where('timetable_id',$idTimetable)
			->get('employ')
			->result_array();*/
	}

	public function deleteTimetable($idTimetable)
	{
		$this->db->where('timetable_id', $idTimetable)->delete('timetable');
	}

	public function addNewTimetable($data)
	{
		$arr  = array();
		$arr = $this->db->select("*")
			->where('name',$data['name'])
			->get('timetable')
			->result_array();
		if (isset($arr[0]))
		{

		}
			else
			{
				$this->db->insert('timetable', $data);
				$dataForEmploy = array();

				$id =  $this->db->insert_id();
				$date = '2016-09-1';
				for ($in = 1; $in <= 7; $in++)
				{
					if (date('w', strtotime('2016-09-' . $in)) == 1)
					{
						$date = '2016-09-' . $in;
						break;
					}
				}
				$position = 1;
				$dateForLesson = $date;
				$dataForLesson = array();
				for ($i = 1; $i <= 42; $i++)
				{
					$dateTemp = $dateForLesson;
					$dataForEmploy['num'] = $i;
					$dataForEmploy['timetable_id'] = $id;
					$this->db->insert('employ', $dataForEmploy);
					$dataForLesson['employ_id'] = $this->db->insert_id();
					$dataForLesson['position'] = $position;
					for ($a = 1; $a <= 22; $a++)
					{
						$dataForLesson['execute_date'] = $dateTemp;
						$this->db->insert('lesson', $dataForLesson);
						$dateDay = new DateTime($dateTemp);
						date_add($dateDay, date_interval_create_from_date_string( '14 days'));
						$dateTemp = $dateDay->format('Y-m-d');
					}
					$position++;
					if ($position == 8)
					{
						$position = 1;
						$dateDay = new DateTime($dateForLesson);
						date_add($dateDay, date_interval_create_from_date_string( '1 days'));
						$dateForLesson = $dateDay->format('Y-m-d');
					}
				}

				$position = 1;
				$dateDay = new DateTime($date);
				date_add($dateDay, date_interval_create_from_date_string( '7 days'));
				$dateForLesson = $dateDay->format('Y-m-d');
				$dataForLesson = array();
				for ($i = 43; $i <= 84; $i++)
				{
					$dateTemp = $dateForLesson;
					$dataForEmploy['num'] = $i;
					$dataForEmploy['timetable_id'] = $id;
					$this->db->insert('employ', $dataForEmploy);
					$dataForLesson['employ_id'] = $this->db->insert_id();
					$dataForLesson['position'] = $position;
					for ($a = 1; $a <= 22; $a++)
					{
						$dataForLesson['execute_date'] = $dateTemp;
						$this->db->insert('lesson', $dataForLesson);
						$dateDay = new DateTime($dateTemp);
						date_add($dateDay, date_interval_create_from_date_string( '14 days'));
						$dateTemp = $dateDay->format('Y-m-d');
					}
					$position++;
					if ($position == 8)
					{
						$position = 1;
						$dateDay = new DateTime($dateForLesson);
						date_add($dateDay, date_interval_create_from_date_string( '1 days'));
						$dateForLesson = $dateDay->format('Y-m-d');
					}
				}
			}




	}

	public function updateNameTimetable($idTametable, $data)
	{
		$arr  = array();
		$arr = $this->db->select("*")
			->where('name',$data['name'])
			->get('timetable')
			->result_array();
		if (isset($arr[0]))
		{

		}
		else $this->db->where('timetable_id',$idTametable)
			->update('timetable', $data);
	}
	public function getSingleTimetable($idTametable)
	{
		return $this->db->select("*")
			->where('timetable_id',$idTametable)
			->get('timetable')
			->result_array();
	}
	public function getTimetableByUserId($id = 1)
	{
		$_arrs = $this->db->select('*')
			->where('user_id', $id)
			->get('timetable')
			->result_array();

		return $_arrs;
	}

	public function getByWeek($id, $week = 1)
	{
		$_arrs = $this->db->select('*')
					->where('timetable_id', $id)
					/*->where('upper_week', (int)($week == 1))*/
					->get('employ')
					->result_array();

		$_res = array();

		/*foreach($_arrs as $key => $value)
		{
			$_res[$value['day']][$value['position']] = $value;
		}
		ksort($_res);*/
		return $_res;
	}

	public function getLesson($id)
	{
		return $this->db->select('*')
						->where('lesson_id', $id)
						->get('lesson')
						->row('0', 'array');
	}

	public function getAll($ownerId)
	{
		return $this->db->select('*')
							->where('user_id', $ownerId)
							->order_by('timetable_id', 'DESC')
							->get('timetable')
							->result_array();
	}

	public function getById($id)
	{
		/*print_r($this);*/
		return $this->db->select('*')
							->where('timetable_id', $id)
							->get('timetable')
							->row('0', 'array');
	}

	public function create($data)
	{
		$this->db->insert('timetable', $data);
		return $this->db->insert_id();
	}

	public function remove($id)
	{
		return $this->db->where('timetable_id', $id)->delete('timetable');
	}

	public function update($id, $data)
	{
		return $this->db->where('timetable_id', $id)->update('timetable', $data);
	}
}

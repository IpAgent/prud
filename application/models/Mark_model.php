<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mark_model extends MF_Model
{

    public function getSubMarksOnEmploy($id_group, $employ_id, $sub){

        $data = $this->db->select("*, student.name as s_name, employ.name as e_name")
            ->from('employ')
            ->join('lesson', 'lesson.employ_id = employ.employ_id')
            ->join('mark', 'mark.lesson_id = lesson.lesson_id')
            ->join('student', 'student.student_id = mark.student_id')
            ->where('student.sub', $sub)
            ->where('employ.employ_id', $employ_id)
            ->where('student.group_id', $id_group)
            ->get()
            ->result_array();
        return $data;
    }

    public function getMarksOnEmploy($id_group, $employ_id){

        $data = $this->db->select("*, student.name as s_name, employ.name as e_name")
            ->from('employ')
            ->join('lesson', 'lesson.employ_id = employ.employ_id')
            ->join('mark', 'mark.lesson_id = lesson.lesson_id')
            ->join('student', 'student.student_id = mark.student_id')
            ->where('employ.employ_id', $employ_id)
            ->where('student.group_id', $id_group)
            ->get()
            ->result_array();
        return $data;
    }

    public function getAllLesson($employ_id)
    {

        $data = $this->db->select("*")
            ->from('employ')
            ->join('lesson', 'lesson.employ_id = employ.employ_id')
            ->where('employ.employ_id', $employ_id)
            ->order_by('lesson.execute_date')
            ->get()
            ->result_array();
        return $data;
    }

    public function getSubGroup($id_group, $sub){
        $data = $this->db->select("*, group.name as gname")
            ->from('group')
            ->join('student', 'student.group_id = group.group_id')
            ->where('group.group_id', $id_group)
            ->where('student.sub', $sub)
            ->order_by('student.name')
            ->get()
            ->result_array();
        return $data;
    }

    public function getGroup($id_group){
        $data = $this->db->select("*, group.name as gname")
            ->from('group')
            ->join('student', 'student.group_id = group.group_id')
            ->where('group.group_id', $id_group)

            ->order_by('student.name')
            ->get()
            ->result_array();
        return $data;
    }




    /*public function getById($id, $type = 'array')
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

       /* return $this->db
            ->where('lesson_id = ', $lessonId)
            ->update('lesson', $data);
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
        return $this->db->select("*")
            ->join('lesson', 'employ.employ_id = lesson.employ_id')
            ->where('timetable_id',$id)
            ->where('execute_date >= ', $start)
            ->where('execute_date <= ', $finish)
            ->get('employ')
            ->result_array();
    }

    public function getLesson($_id_timetable, $_date, $_position, $lessonId)
    {
        $data = array();
        $data = $this->db->select("*, g.name as gname, e.name as name")
            ->from('employ as e')
            ->join('lesson', 'e.employ_id = lesson.employ_id')
            ->join('employ_group','employ_group.employ_id = e.employ_id')
            ->join('group as g','g.group_id = employ_group.group_id')
            ->where('timetable_id',$_id_timetable)
            ->where('execute_date = ', $_date)
            ->where('position = ', $_position)
            ->where('lesson_id = ', $lessonId)
            ->get()
            ->result_array();
        if (isset($data[0])) return $data;
        else
            return $this->db->select("*, e.name as name")
                ->from('employ as e')
                ->join('lesson', 'e.employ_id = lesson.employ_id')
                ->where('timetable_id',$_id_timetable)
                ->where('execute_date = ', $_date)
                ->where('position = ', $_position)
                ->where('lesson_id = ', $lessonId)
                ->get()
                ->result_array();
    }

    public function Test($id){
        $data = $this->db->select("*")
            ->from('group')
            ->join('student', 'student.group_id = group.group_id')
            ->where('group.group_id', $id)
            ->get()
            ->result_array();
        return $data;
    }*/
}
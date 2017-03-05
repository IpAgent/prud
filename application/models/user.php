<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MF_Model
{
	public function getById($id)
	{
		return $this->db->select('*')
						->where('user_id', $id)
						->get('user')
						->row(0);
	}

	public function getByLogin($login = '')
	{
		//print_r($login);exit;
		return $this->db->select('*')
						->where('login', (string)$login)
						->get('user')
						->row(0);
	}

	public function getByLoginData($param = array())
	{
		if(!$param || !$param['login'] || !$param['password']) return null;

		$_user = $this->getByLogin($param['login']);

		$_hash = sha1($param['password'] . $_user->salt);

		if($_user->password === $_hash)
		{
			return $_user;
		}
		return null;
	}

	public function create($param = array())
	{
		if($this->getByLogin($param['login']) != null) return false;

		$_salt = sha1(uniqid());

		$_data = array();
		$_data['login'] = $param['login'];
		$_data['password'] = sha1($param['password'] . $_salt);
		$_data['salt'] = $_salt;

		$this->db->insert('user', $_data);

		return $this->getByLogin($param['login']);
	}
}

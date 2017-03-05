<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json
{
   private $_return = array();
   
   function __construct()
   {
      $this->_return = array('success' => false,'messages' => array());
   }

	public function addMessage($msg, $cat = '0')
	{
		$this->_return[$cat][] = $msg;
	}
	
	public function setData($data)
	{
		$this->_return['data'] = $data;
		return $this;
	}
   
   public function sendSuccess($data = array())
   {
      $this->_return['success'] = true;
      if($data) 
         $this->_return['data'] = $data;
      $this->_send();
   }
   
   public function sendFailure()
   {
      $this->_return['success'] = false;
      //$errors = $this->messages->get('error');
      //foreach($errors as $error)
      //   $this->_return['messages'][]=$error;
      $this->_send();
   }
   
   private function _send()
   {
      $CI = &get_instance();

      $CI->output->set_header('Content-Type: application/json;charset=UTF-8')
                  ->set_status_header()
                  //->set_output()
                  ->_display(json_encode($this->_return));
      exit;
   }
}

#end of file
<?php
class A_login extends CI_Controller
{
	var $name;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('myfun');
		$this->load->helper('url');
		$this->load->model('admin_model');
	}
	
	public function index()
	{
		$this->load->view('admin/login');
	}
	
	public function checkLogin()
	{
		$userName=$this->input->post('userName');
		$userPwd=md5($this->input->post('userPwd'));
		$data_info=$this->admin_model->user_name_select($userName);
		
		if($data_info == false){
			admin_msg('back','没有该管理员');
			return;
		}else{
			$data_id=$data_info[0]['id'];
			$data_name=$data_info[0]['name'];
			$data_pwd=$data_info[0]['password'];
		}
		
		if($userName != $data_name)
		{
			admin_msg('back','管理员不存在');
			return;
		}elseif($userPwd != $data_pwd ){
				admin_msg('back','管理员密码错误');
				return;
			}else{
				$this->load->helper('cookie');
				$last_time = time()+3600;
				$cookie = array(
					'name'   => 'my',
					'value'  => $data_name,
					'expire' => $last_time,
					);
				$this->input->set_cookie($cookie);/* 创建cookie */
				admin_msg('a_setting');
			}
	}
	
	
	public function login_out()
	{
		$this->load->helper('cookie');
		delete_cookie('my');
		admin_msg('a_login');
	}
	
	
	
}


?>
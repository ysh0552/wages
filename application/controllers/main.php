<?php 
require_once "z_top.php";
class Main extends z_top
{
	var $interfaceCode;
	public function __construct()
	{
		parent::__construct();
		if($_SESSION['loginUpinfo'] != true){
			admin_msg('login');
			exit;
		}
		$this->interfaceCode = $this->input->cookie('interfaceCode');
	}
	
	public function index()
	{
		header('Content-Type: text/html; charset=utf-8'); 
		if($_SESSION['employeesNo'] && $_SESSION['name']){
			$getIP = getIP();
			$cookie = array(
				'name'   => 'getip',
				'value'  => $getIP,
				'expire' => 7200,
				);
			$this->input->set_cookie($cookie);/* 创建cookie */

			$employeesNo = $_SESSION['employeesNo'];
			$name = $_SESSION['name'];
			$params = array(
						'employeesNo'=>$employeesNo,
						'name'=>$name
				);
			$info = getInterface('HaiWangRenShi_WageDetail',$params,$this->interfaceCode,'GET');

			$isGetIP = $this->input->cookie('getip');

			$data['info'] = '';

			if($info->CustomStatus == 10){
				$data['info'] = $info;
			}

		
		
			// $this->db->insert('log',
			// 	array(
			// 		'ip'=>$getIP,
			// 		'str'=>$info->ShiFaGongZi,
			// 		'jsonData'=> var_export($info,true)
			// 	));
			
			// $data['info'] = $info;
		}
		
		$this->load->view('header');
		$this->load->view('main',$data);
		$this->load->view('footer');
	}



	/**
	 * 修改手机号码
	 */
	public function modifyPhone()
	{
		$act = $this->input->post('act');
		if($act == 'submit'){
			$card=$this->input->post('card');
			$mobile=$this->input->post('mobile');
			$newmobile=$this->input->post('newmobile');

			$params = array(
					'idCard'=>$card,
					'mobile'=>$mobile,
					'newMobile'=>$newmobile
			);
			$info = getInterface('HaiWangRenShi_Member',$params,$this->interfaceCode,'GET');
			echo json_encode($info);
		}else{
			$this->load->view('header');
			$this->load->view('modifyphone');
			$this->load->view('footer');
		}
	}

}

?>
<?php 
require_once "z_top.php";
class Registered extends z_top
{
	var $interfaceCode;
	public function __construct()
	{
		parent::__construct();
		$this->interfaceCode = $this->input->cookie('interfaceCode');
	}
	
	public function index()
	{
		$data['info']='';
		$this->load->view('header');
		$this->load->view('registered',$data);
		$this->load->view('footer');
	}

	/**
	 * 注册
	 */
	public function userRegister()
	{
		$name       = $this->input->post('username');
		$EmployeeNo = $this->input->post('jobnumber');
		$IDCard     = $this->input->post('card');
		$Mobile     = $this->input->post('mobile');

		$params = array(
				'name'       =>$name,
				'EmployeeNo' =>$EmployeeNo,
				'IDCard'     =>$IDCard,
				'Mobile'     =>$Mobile
		);
		$info = getInterface('HaiWangRenShi_Register',$params,$this->interfaceCode,'POST');
		echo json_encode($info);

	}

	
}

?>
<?php 
require_once "z_top.php";
class Login extends z_top
{
	var $interfaceCode;
	public function __construct()
	{
		parent::__construct();
		
		$this->interfaceCode = $this->input->cookie('interfaceCode');
	}
	
	public function index()
	{

		if(isset($_SESSION['loginUpinfo']) && $_SESSION['loginUpinfo'] == true){
			admin_msg('main');
			exit;
		}
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	/**
	 * 提交
	 */
	public function loginUp(){
		$card=$this->input->post('card');
		$mobile=$this->input->post('mobile');

		$params = array(
				'idCard'=>$card,
				'mobile'=>$mobile
		);
		$info = getInterface('HaiWangRenShi_Member',$params,$this->interfaceCode,'GET');

		if($info->CustomStatus == 10){
			$_SESSION['employeesNo'] = $info->EmployeeNo;
			$_SESSION['name'] = $info->Name;
			$_SESSION['loginUpinfo'] = true;
			echo 1;
		}else{
			echo $info->CustomMessage;
		}
	}
	
	/**
	 * 获取短信验证码
	 */
	public function sendSMS(){
		$mobile=$this->input->post('mobile');
		$params = array(
				'mobile'=>$mobile,
				'CodeType'=>3
		);
		$info = getInterface('HaiWangRenShi_SMS',$params,$this->interfaceCode,'POST');
		echo json_encode($info);
	}
	
	/**
	 * 验证码是否正确
	 */
	public function isSendSMS(){
		$mobile=$this->input->post('mobile');
		$code=$this->input->post('code');
		$params = array(
				'mobile'=>$mobile,
				'code'=>$code,
				'CodeType'=>3
		);

		//测试
		// $info = array('CustomStatus'=>10);
		// echo json_encode($info);

		$info = getInterface('HaiWangRenShi_SMS',$params,$this->interfaceCode,'GET');
		echo json_encode($info);
		
	}

	/**
	 * 退出
	 */
    public function sessionOuts()
    {
    	$_SESSION['employeesNo'] = '';
		$_SESSION['name'] = '';
		$_SESSION['loginUpinfo'] = false;
		admin_msg('login');
    }


	
}

?>
<?php
require_once "common.php";
class Login extends common
{
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$areaMobile = $this->input->cookie('areaMobile');
		if(!empty($areaMobile)){
			admin_msg('areamanager/main');
			exit;
		}
		$this->load->view('areaManager/header');
		$this->load->view('areaManager/login');
		$this->load->view('areaManager/footer');
	}

	/**
	 * 获取短信验证码
	 */
	public function sendSMS(){
		$mobile=$this->input->post('mobile');
		$params = array(
				'mobile'=>$mobile,
				'codeType'=>6
		);

		$info = getAreaInterface('CommonCheckUserSMS/Post',$params);
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
				'CodeType'=>6
		);

		$info = getAreaInterface('CommonCheckUserSMS/Get',$params,"GET");
		if($info->CustomStatus == 10){
			$this->input->set_cookie('areaMobile',$mobile,time()+3600);
		}

		echo json_encode($info);
		exit;
		
		
	}

	/**
	 * 退出
	 */
    public function sessionOuts()
    {
    	$this->input->set_cookie('areaMobile','');
		admin_msg('areamanager/login');
    }

}


?>
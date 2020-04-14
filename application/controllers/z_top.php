<?php
session_start();
class Z_top extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('myfun');
		$this->load->model('interface_model');
		$this->load->helper('cookie');
		$inter = $this->interface_model->user_select(1);

		//获取请求头
		if($inter[0]['code'] == '' || $inter[0]['times'] < time()){
			$headerCode = getInterfaceHeader();
			if($headerCode){
				$arr = array(
						'code'=>$headerCode->access_token,
						'times'=>time()+$headerCode->expires_in
				);
				$this->interface_model->user_update(1,$arr);
			}
		}
		
		$interfaceCode = $this->input->cookie('interfaceCode');
		//cookie
		if(!$interfaceCode || $interfaceCode != $inter[0]['code']){
			
			$last_time = time()+3600;
			$cookie = array(
					'name'   => 'interfaceCode',
					'value'  => $inter[0]['code'],
					'expire' => $last_time
			);
			$this->input->set_cookie($cookie);
		}
		
		
	}

}


?>
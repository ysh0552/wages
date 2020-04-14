<?php 
require_once "common.php";
class Main extends common
{
	public function __construct()
	{
		parent::__construct();
		$areaMobile = $this->input->cookie('areaMobile');
	
		if(empty($areaMobile)){
			$this->input->set_cookie('areaMobile','');
			admin_msg('areamanager/login');
			exit;
		}
	}
	
	public function index()
	{
		$mobile = $this->input->cookie('areaMobile');

		$data['list']='';
		$data['info']='';
		$data['RegionName']   ='';
		$data['SliceName']    ='';
		$data['ManagerName']  ='';
		$data['MonthTasks']   ='';
		$data['Summary']      ='';
		$data['DayTask']      ='';
		$data['CateGoryName'] ='';
		$data['Quantity']     ='';
		$data['MonthPercen']  ='';
		$data['DayPercen']    ='';


		if(!empty($mobile)){
			$params = array('mobile'=>$mobile,'inDate'=>date('Ymd'));
			$info = getAreaInterface('SliceAreaTaskRePort/SliceAreaRePortDetail',$params);

			if(count($info->data) > 0){
				$data['list']=$info->data[0]->ReportList;
				$data['info']=$info->data[0];
			}
			
			$AreaTaskParams = array('mobile'=>$mobile);
			$AreaTaskinfo = getAreaInterface('SliceAreaTaskRePort/GetSliceAreaTask',$AreaTaskParams,'GET');


			if(count($AreaTaskinfo) > 0){
				$data['RegionName']   = $AreaTaskinfo->RegionName;	 //大区名称
				$data['SliceName']    = $AreaTaskinfo->SliceName;	 //片区名称
				$data['ManagerName']  = $AreaTaskinfo->ManagerName;	 //片区经理
				$data['MonthTasks']   = $AreaTaskinfo->MonthTasks;	 //月份计划数
				$data['Summary']      = $AreaTaskinfo->Summary;	     //当月完成数
				$data['DayTask']      = $AreaTaskinfo->DayTask;	     //日计划数
				$data['CateGoryName'] = $AreaTaskinfo->CateGoryName; //分类名称
				$data['Quantity']     = $AreaTaskinfo->Quantity;	 //当日完成数
				$data['MonthPercen']  = $AreaTaskinfo->MonthPercen;	 //月份完成比例
				$data['DayPercen']    = $AreaTaskinfo->DayPercen;    //当日完成比例
			}

		}

		$this->load->view('areaManager/header');
		$this->load->view('areaManager/main',$data);
		$this->load->view('areaManager/footer');
	}


	/**
	 * 上报资料
	 */
	public function addinfo(){
		$this->load->view('areaManager/header');
		$this->load->view('areaManager/addinfo');
		$this->load->view('areaManager/footer');
	}

	/**
	 * 上报资料提交
	 */
	public function ajax_infoSave(){

		$mobile = $this->input->post('mobile');
		$data = $this->input->post('data');
		$inDataDate = $this->input->post('inDataDate');
		$params = array('mobile'=>$mobile,'data'=>$data,'inDataDate'=>$inDataDate);
		$info = getAreaInterface('SliceAreaTaskRePort/SendSliceAreaRePort',$params);
		
		$infos = array('info'=>$info,'jumpUrl'=>site_url('areamanager/main'));

		echo json_encode($infos);
		exit;

	}

	/**
	 * 查询历史数据
	 */
	public function history(){
		$sreach = $this->input->post('sreach');
		$mobile = $this->input->post('mobile');
		$inDate = $this->input->post('inDate');
		$inMonth = $this->input->post('inMonth');
		if($sreach == '1'){
			if($mobile){
				$params = array('mobile'=>$mobile,'inDate'=>$inDate,'inMonth'=>$inMonth);
				$info = getAreaInterface('SliceAreaTaskRePort/SliceAreaRePortDetail',$params);
				$returns['lists']='';
				if(count($info->data) > 0){
					$returns['lists']=$info->data[0];
				}
				echo json_encode($returns);
				exit;
			}
		}
		$this->load->view('areaManager/header');
		$this->load->view('areaManager/history');
		$this->load->view('areaManager/footer');
	}


	/**
	 * 获取片区上报汇总记录
	 *  往前推几个月
	 */
	public function summary(){

		$inMonth = $this->input->post('inMonth');
		$mobile = $this->input->post('mobile');
		
		$params = array('mobile'=>$mobile,'inMonth'=>$inMonth);
		$info = getAreaInterface('SliceAreaTaskRePort/SliceAreaRePortSummary',$params);

		if(count($info->data) > 0){
			$returns['lists']=$info->data;
		}

		echo json_encode($info);
		exit;



	}



	




}

?>
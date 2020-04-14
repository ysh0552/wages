<?php
class interface_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//插入数据库
	public function user_insert($arr)
	{
		$this->db->insert('interface',$arr);
	}
	
	//查询数据
	public function user_select($id='')
	{
		if($id != ''){
			$this->db->where('id',$id);
		}
	
		$query=$this->db->get('interface');
		return $query->result_array();
	}
	
	//查询数据
	public function user_name_select($name='')
	{
		if($name!= ''){
			$this->db->where('name',$name);
		}
		$query=$this->db->get('interface');
		return $query->result_array();
	}
	
	//查询数据 roll
	public function user_roll_select($roll='')
	{
		if($roll != ''){
			$this->db->where('roll',$roll);
		}
		$this->db->order_by('id','desc');
		$query=$this->db->get('interface');
		return $query->result_array();
	}
	
	
	//更新数据
	public function user_update($id,$str)
	{
		$this->db->where('id',$id);
		$this->db->update('interface',$str);
	}
	
	//删除数据
	public function user_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('interface');
	}
	
	
	
}

?>
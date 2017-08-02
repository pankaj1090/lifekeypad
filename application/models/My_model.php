<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {

	function __Construct(){ 		 # create constructor 
		$this->load->database();		 # load the database
	} 
	
	# function for select data from database , with condition , limit , order , like and join clause
	function select_data($field , $table , $where = '' , $limit = '' , $order = '' , $like = '' , $join_array = '' , $group = ''){ 
		$this->db->select($field);
		$this->db->from($table);
		if($where != ""){ 
			$this->db->where($where);
		}
	
		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					$this->db->join($joinArray[0], $joinArray[1]);
				}
			}else{
				$this->db->join($join_array[0], $join_array[1]);
			}
		}
		
		if($order != ""){
			$this->db->order_by($order['0'] , $order['1']);
		}
		
		if($group != ""){
			$this->db->group_by($group);
		}
		
		if($limit != ""){
			if(count($limit)>1){
				$this->db->limit($limit['0'] , $limit['1']);
			}else{
				$this->db->limit($limit);
			}
			
		}
		
		/*if($like != ''){
			$this->db->like($like);
		}*/

		if($like != "" ){
			$like_key = explode(',',$like['0']);
			$like_data = explode(',',$like['1']);
			for($i=0; $i<count($like_key); $i++){					
				if($like_data[$i] != ''){
					if($i == 0){
						$this->db->like($like_key[$i] , $like_data[$i]);
					}else{
						$this->db->or_like($like_key[$i] , $like_data[$i]);
					}
					
				}
			} 
		}	
		return $this->db->get()->result_array();
		die();
	}
	
	# function for insert data in database  
	function insert_data($table , $data){
		$this->db->insert($table , $data);
		return $this->db->insert_id();
		die();
	}
	
	# function for delete data from database 
	function delete_data($table , $condition){
		return $this->db->delete($table,$condition);
		die();
	}
	
	# function for update data in database 
	function update_data($table , $data , $condition){
		$this->db->where($condition);
		return $this->db->update($table,$data);
		die();
	}
	
	
	# function for call the aggregate function like as 'SUM' , 'COUNT' etc 
	function aggregate_data($table , $field_nm , $function , $where = NULL , $join_array = NULL,$like=NULL){
		$this->db->select("$function($field_nm) AS MyFun");
        $this->db->from($table);
		if($where != ''){
			 $this->db->where($where);
		}
		
		if($join_array != ''){
			if(in_array('multiple',$join_array)){
				foreach($join_array['1'] as $joinArray){
					$this->db->join($joinArray[0], $joinArray[1]);
				}
			}else{
				$this->db->join($join_array[0], $join_array[1]);
			}
		}
		if($like != ""){
			$like_key = explode(',',$like['0']);
			$like_data = explode(',',$like['1']);
			for($i='0'; $i<count($like_key); $i++){
				if($like_data[$i] != ''){
					$this->db->like($like_key[$i] , $like_data[$i]);
				}
			} 
		}	
		
        $query1 = $this->db->get();
		
        if($query1->num_rows() > 0){ 
			$res = $query1->row_array();
			return $res['MyFun'];													
        }else{
			return array();
		}  
		die();  
	}
	

	
	
}
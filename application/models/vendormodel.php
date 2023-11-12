<?php
    class VendorModel extends CI_Model
    {
		var $val=0;
		function __construct(){
		   
			//parent::Model();
			$this->load->database();
		}
		
		public function loginUser($username, $password)
        {
            $val=0;
			$this->db->select('user_id,username,password,status,vendorid');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
			$query = $this->db->get('tr_user');
			$rows=$query->result(); 
			//print_r($rows);
			foreach ($rows as $row){
				$val=$row->user_id;
				$username=$row->username;
				$vendorid=$row->vendorid;
				$statusid=$row->status;
			}
			if($val > 0){ 
			//echo $vlcheck;
			$sessiondata = array(
				'username' =>$val,
				'verdorid' =>$vendorid,
				'status' =>$statusid
			);
			//print_r($sessiondata);
			$this->session->set_userdata($sessiondata);
		 }
             return $val;
        }
		
		
	}
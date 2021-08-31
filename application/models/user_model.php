<?php

    class User_model extends CI_Model
    {
	    public function getDataUser($empId)
	    {
		    $this->db->where('empId', $empId);
		    return $this->db->get('employee')->row();
	    }

		public function countData()
		{
			return $this->db->count_all('customer');
		}
    }
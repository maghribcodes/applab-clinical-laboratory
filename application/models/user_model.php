<?php

    class User_model extends CI_Model
    {
	    public function getDataUser($empId)
	    {
		    $this->db->where('empId', $empId);
		    return $this->db->get('employee')->row();
	    }

		public function getCountVisitors()
		{
			return $this->db->count_all('customer');
		}

		public function getCountSamples()
		{
			return $this->db->count_all('testresult');
		}
    }
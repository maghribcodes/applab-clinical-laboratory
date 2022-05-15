<?php

    class User_model extends CI_Model
    {
	    function getDataUser($empId)
	    {
			$this->db->select('*');
			$this->db->from('role');
			$this->db->join('employee', 'role.roleId=employee.roleId');
			$this->db->join('lab', 'employee.labId=lab.labId');
		    $this->db->where('empId', $empId);

		    return $this->db->get()->row();
	    }

		function getCountVisitors()
		{
			return $this->db->count_all('customer');
		}

		function getCountSamples()
		{
			return $this->db->count_all('sample');
		}

		function getCountParameters()
		{
			return $this->db->count_all('parameter');
		}

		function getCountLhus()
		{
			$this->db->like('statusId', 1);
			$this->db->or_like('statusId', 2);
			$this->db->or_like('statusId', 3);
			$this->db->or_like('statusId', 4);
			$this->db->from('order');
			return $this->db->count_all_results();
		}

		function getCountLhu()
		{
			$this->db->like('statusId', 5);
			$this->db->or_like('statusId', 6);
			$this->db->from('order');
			return $this->db->count_all_results();
		}

		function barChart()
		{
			$this->db->select('DATE_FORMAT(orderTime, "%M") AS bulan, COUNT(*) AS total');
			$this->db->from('order');
			$this->db->group_by('DATE_FORMAT(OrderTime, "%M")');
			$this->db->order_by('Month(OrderTime)');
			return $this->db->get();
		}

		function pieChart()
		{
			$query = "SELECT COUNT(*) AS total, gender FROM customer GROUP BY gender ORDER BY gender ASC";
        	$result = $this->db->query($query)->result_array();
        	return $result;
		}
    }
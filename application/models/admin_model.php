<?php

    class Admin_model extends CI_Model
    {
        function getAllEmployee($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('employee.empName', $keyword);
                $this->db->or_like('role.roleName', $keyword);
			}

			$this->db->select('*');
			$this->db->from('employee');
			$this->db->join('role', 'employee.roleId=role.roleId', 'left');
            $this->db->order_by('employee.empId', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

        function getRoles()
        {
            $this->db->select('*');
            $this->db->from('role');

            return $this->db->get();
        }

		function getEmp($empId)
		{
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->where('employee.empId', $empId);

			return $this->db->get();
		}

		function getPackages()
		{
			$this->db->select('*');
            $this->db->from('package');

            return $this->db->get();
		}

		function getLab($empId)
		{
			$this->db->select('*');
			$this->db->from('lab');
			$this->db->join('package', 'lab.packageId=package.packageId', 'left');
			$this->db->where('lab.empId', $empId);

			return $this->db->get();
		}
        
        function inputData($table, $data)
		{
			$query=$this->db->insert($table, $data);
			return $this->db->insert_id();
		}

		function updateData($where, $table, $data)
		{
			$this->db->where($where);
			$this->db->update($table, $data);
		}

		function deleteData($where, $table)
		{
			$this->db->where($where);
			$this->db->delete($table);
		}

		function getCountEmployees()
		{
			return $this->db->count_all('employee');
		}
    }
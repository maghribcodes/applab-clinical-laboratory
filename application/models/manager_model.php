<?php

    class Manager_model extends CI_Model
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
			$this->db->join('lab', 'employee.labId=lab.labId', 'left');
            $this->db->order_by('employee.empId', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllParameters($limit, $start, $keyword = null)
		{
			if($keyword)
			{
				$this->db->like('parameter.parameterName', $keyword);
			}

			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
            $this->db->order_by('parameter.parameterId', 'desc');
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
			$this->db->where('empId', $empId);

			return $this->db->get();
		}

		function getLabs()
		{
			$this->db->select('*');
            $this->db->from('lab');

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

		function getParam($parameterId)
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('parameterId', $parameterId);

			return $this->db->get();
		}

		function getPackages()
		{
			$this->db->select('*');
			$this->db->from('lab');
			$this->db->not_like('labId', '1');

            return $this->db->get();
		}
    }
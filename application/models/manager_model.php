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
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
            $this->db->order_by('parameter.parameterName', 'asc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
		}

		function getAllTestResult($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('customer.custName', $keyword);
			}

            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('testresult', 'testresult.noSample=orderdetail.noSample', 'left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
            $this->db->group_by('order.orderId');
			$this->db->order_by('order.orderId', 'desc');
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

		function getLastIdA()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->like('parameterId', 'A');

            return $this->db->get();
		}

		function getLastIdB()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->like('parameterId', 'B');

            return $this->db->get();
		}

		function getLastIdC()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->like('parameterId', 'C');

            return $this->db->get();
		}

		function getLastIdD()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->like('parameterId', 'D');

            return $this->db->get();
		}

		function getParam($parameterId)
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('parameterId', $parameterId);

			return $this->db->get();
		}

		function getPack($packageId)
		{
			$this->db->select('*');
			$this->db->from('package');
			$this->db->where('packageId', $packageId);

			return $this->db->get();
		}
    }
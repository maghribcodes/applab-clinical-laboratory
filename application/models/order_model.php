<?php

    class Order_model extends CI_Model
    {
		function getDataCustomer($limit, $start, $keyword = null)
	    {
			if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
				$this->db->or_like('customer.custName', $keyword);
				$this->db->or_like('order.sender', $keyword);
			}

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples,
									GROUP_CONCAT(DISTINCT sampleType SEPARATOR "-") as Types');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
	    }

		function getDataOrder($orderId)
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('employee', 'order.empId=employee.empId', 'left');
			$this->db->join('testresult', 'testresult.noSample=orderdetail.noSample', 'left');
			$this->db->where('order.orderId', $orderId);
			
			return $this->db->get();
		}

		function getAllParameters()
		{
			$this->db->select('*');
			$this->db->from('parameter');

			return $this->db->get();
		}

		function getParameterA()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'A');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function getParameterB()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'B');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function getParameterC()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'C');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function getParameterD()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'D');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function inputDataOrder($table, $data)
		{
			$query=$this->db->insert($table, $data);
			return $this->db->insert_id();// return last insert id
		}

		function updateDataOrder($where, $table, $data)
		{
			$this->db->where($where);
			$this->db->update($table, $data);
		}

		function deleteDataOrder($where, $table)
		{
			$this->db->where($where);
			$this->db->delete($table);
		}
    }
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

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples');
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
			$this->db->join('sample', 'sample.noSample=orderdetail.noSample', 'left');
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
			$this->db->where('labId', '2');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function getParameterB()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('labId', '3');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function getParameterC()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('labId', '4');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		function getParameterD()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('labId', '5');
			$this->db->order_by('parameterName', 'asc');

			return $this->db->get();
		}

		public function get_idmax()
		{
			$this->db->select_max('noSample');
			$this->db->from('sample');
			$query = $this->db->get();
			
			return $query;   
		}

		public function get_newid($auto_id, $prefix)
		{
			$newId = substr($auto_id, 2, 4);
			$tambah = (int)$newId + 1;
			if(strlen($tambah) == 1)
			{
			   $noSample = $prefix."000" .$tambah;
			}
			else if(strlen($tambah) == 2)
			{
			   $noSample = $prefix."00" .$tambah;
			}
			else if(strlen($tambah) == 3)
			{
			   $noSample = $prefix."0".$tambah;   
			}
			else if(strlen($tambah) == 4)
			{
			   $noSample = $prefix.$tambah;   
			}
			return $noSample;
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
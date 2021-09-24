<?php

    class Order_model extends CI_Model
    {
	    public function getDataCustomer()
	    {
			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR ", ") as Samples');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->group_by('order.orderId');
			//$this->db->order_by('order.orderId', 'desc');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');

			return $this->db->get();
	    }

		public function getDataOrder($orderId)
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('nota', 'order.notaId=nota.notaId', 'left');
			$this->db->join('employee', 'nota.empId=employee.empId', 'left');
			$this->db->join('testresult', 'testresult.noSample=orderdetail.noSample', 'left');
			$this->db->where('order.orderId', $orderId);
			
			return $this->db->get();
		}

		public function getAllParameters()
		{
			$this->db->select('*');
			$this->db->from('parameter');

			return $this->db->get();
		}

		public function getParameterA()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'A');
			$this->db->order_by('parameterId', 'asc');

			return $this->db->get();
		}

		public function getParameterB()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'B');
			$this->db->order_by('parameterId', 'asc');

			return $this->db->get();
		}

		public function getParameterC()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'C');
			$this->db->order_by('parameterId', 'asc');

			return $this->db->get();
		}

		public function getParameterD()
		{
			$this->db->select('*');
			$this->db->from('parameter');
			$this->db->where('packageId', 'D');
			$this->db->order_by('parameterId', 'asc');

			return $this->db->get();
		}

		public function getAllSamples()
		{
			$this->db->select('noSample');
			$this->db->from('testresult');
			
			return $this->db->get();
		}

		public function inputDataOrder($table, $data)
		{
			$query=$this->db->insert($table, $data);
			return $this->db->insert_id();// return last insert id
		}

		public function updateDataOrder($where, $table, $data)
		{
			$this->db->where($where);
			$this->db->update($table, $data);
		}

		public function deleteDataOrder($where, $table)
		{
			//$this->db->where($where);
			//$this->db->delete($table);

			/*$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('nota', 'order.notaId=nota.notaId', 'left');
			$this->db->join('testresult', 'testresult.noSample=orderdetail.noSample', 'left');*/
			//$this->db->where('orderdetail.orderId', $orderId);
			$this->db->where($where);
			$this->db->delete($table);
		}
    }
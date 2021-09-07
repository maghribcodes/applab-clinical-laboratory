<?php

    class Order_model extends CI_Model
    {
	    public function getDataOrder()
	    {
		    /*$this->db->select('testresult.*, customer.*, order.*, orderdetail.*');
            $this->db->from('testresult, customer, order, orderdetail');
			$this->db->where('testresult.noSample=orderdetail.noSample');
            $this->db->where('order.orderId=orderdetail.orderId');
		    $this->db->where('order.custId=customer.custId');*/

			$this->db->select('*');
			$this->db->from('customer');
			$this->db->join('order', 'order.custId=customer.custId');
			$this->db->order_by('order.orderId','desc');

		    return $this->db->get();
	    }

		public function getDataNota()
		{
			$this->db->select('*');
			$this->db->from('customer, nota, order, parameter');
			$this->db->join('orderdetail', 'orderdetail.parameterId=parameter.parameterId', 'orderdetail.orderId=order.orderId');

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

		public function getTotalCost()
		{
			return $this->db->query("SELECT SUM(parameterCost) as total FROM parameter");
		}

		public function inputDataOrder($table, $data)
		{
			$query=$this->db->insert($table, $data);
			return $this->db->insert_id();// return last insert id
		}
    }
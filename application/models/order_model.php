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

		public function getTotalCost()
		{
			//$this->db->select('SELECT SUM(parameterCost) AS Total Cost', FALSE);
			//$this->db->from('parameter');

		    //return $this->db->get();
			$this->db->where('parameterId', $parameterId);
		    return $this->db->get('parameter')->row();
		}

		public function inputDataOrder($table, $data)
		{
			$query=$this->db->insert($table, $data);
			return $this->db->insert_id();// return last insert id
		}
    }
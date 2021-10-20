<?php

    class Doctor_model extends CI_Model
    {
		function getDataCustomer()
		{
			$this->db->select('*');
			$this->db->from('order');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
            $this->db->where('order.sender', '');
			$this->db->order_by('order.orderId', 'asc');

			return $this->db->get();
		}

        function getDataClinical($orderId)
		{
			$this->db->select('*');
			$this->db->from('order');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
            $this->db->where('order.sender', '');
			$this->db->where('order.orderId', $orderId);
			$this->db->order_by('order.orderId', 'asc');

			return $this->db->get();
		}

        function getTestResult($limit, $start, $keyword = null)
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
            $this->db->group_by('order.orderId');
			$this->db->order_by('order.orderId', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }
    }
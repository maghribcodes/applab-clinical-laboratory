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

        function getTestResult()
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('testresult', 'testresult.noSample=orderdetail.noSample', 'left');
            $this->db->where('testresult.statusId', 0);
            $this->db->group_by('orderdetail.orderId');

			return $this->db->get();
        }
    }
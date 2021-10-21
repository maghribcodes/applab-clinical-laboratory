<?php

    class Sample_model extends CI_Model
    {
        function getDataOrders()
        {
            $this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples,
									GROUP_CONCAT(DISTINCT sampleType SEPARATOR "-") as Types');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
            $this->db->where('orderdetail.sampleType', '');
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'asc');

			return $this->db->get();
        }

        function getDataSamples($orderId)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
            $this->db->where('order.orderId', $orderId);

			return $this->db->get();
        }
    }
<?php

    class Sample_model extends CI_Model
    {
        function getDataSamples()
        {
            $this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples,
									GROUP_CONCAT(DISTINCT sampleType SEPARATOR "-") as Types');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
            $this->db->where('orderdetail.sampleType', '');
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');

			return $this->db->get();
        }
    }
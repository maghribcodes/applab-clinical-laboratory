<?php

    class Sample_model extends CI_Model
    {
        function getDataOrders($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
				$this->db->or_like('customer.custName', $keyword);
				$this->db->or_like('order.sender', $keyword);
			}

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples,
                                    GROUP_CONCAT(DISTINCT sampleType SEPARATOR ", ") as Types');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
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
<?php

    class Reporting_model extends CI_Model
    {
        function getAllCustomers($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('customer.custName', $keyword);
			}

			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
            $this->db->join('testresult', 'orderdetail.noSample=testresult.noSample', 'left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
			$this->db->group_by('order.orderId');
			$this->db->order_by('order.orderId', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getTestResult($orderId)
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->join('testresult', 'testresult.noSample=orderdetail.noSample', 'left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->where('order.orderId', $orderId);
			
			return $this->db->get();
		}

		function getParameters($orderId)
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->group_by('orderdetail.parameterId');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->where('orderdetail.orderId', $orderId);
			
			return $this->db->get();
		}

		function getCountLhu()
		{
			$this->db->like('statusId', '2');
			$this->db->from('testresult');
			return $this->db->count_all_results();
		}
    }
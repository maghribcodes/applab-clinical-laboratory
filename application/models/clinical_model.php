<?php

    class Clinical_model extends CI_Model
    {
        function countAllOrders()
		{
			return $this->db->get('order')->num_rows();
		}

		function getDataClinical($limit, $start, $keyword = null)
		{
			if($keyword)
			{
				$this->db->like('customer.custName', $keyword);
				$this->db->or_like('customer.gender', $keyword);
				$this->db->or_like('customer.address', $keyword);
			}

			$this->db->select('*');
			$this->db->from('order');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->order_by('order.orderId', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
		}

		function getDataCustomer($custId)
		{
			$this->db->select('*');
			$this->db->from('customer');
			$this->db->where('custId', $custId);

			return $this->db->get();
		}

		function getOrder(){
			return $this->db->get('order')->num_rows();
		}

        function inputDataClinical($table, $data)
		{
			$query=$this->db->insert($table, $data);
			return $this->db->insert_id();// return last insert id
		}

		function updateDataClinical($where, $table, $data)
		{
			$this->db->where($where);
			$this->db->update($table, $data);
		}

		function deleteDataClinical($where, $table)
		{
			$this->db->where($where);
			$this->db->delete($table);
		}
    }
<?php

    class Clinical_model extends CI_Model
    {
        function getDataClinical()
		{
			$this->db->select('*');
			$this->db->from('order');
			$this->db->join('customer', 'order.custId=customer.custId', 'left');
			$this->db->order_by('order.orderId', 'desc');

			return $this->db->get();
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
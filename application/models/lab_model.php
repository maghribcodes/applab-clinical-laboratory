<?php

    class Lab_model extends CI_Model
    {
        function getAllSamples($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
			}

			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
            $this->db->join('testresult', 'orderdetail.noSample=testresult.noSample', 'left');
			$this->db->group_by('testresult.noSample');
            $this->db->order_by('orderdetail.noSample', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

        function getSample($orderId)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('testresult', 'orderdetail.noSample=testresult.noSample', 'left');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
            $this->db->where('orderdetail.orderId', $orderId);

			return $this->db->get();
        }

        function getCountSamples()
		{
			$this->db->where('result', '');
			$this->db->from('orderdetail');
            $this->db->group_by('noSample');
			return $this->db->count_all_results();
		}

        function getCountLhus()
		{
			$this->db->like('statusId', '1');
			$this->db->from('testresult');
			return $this->db->count_all_results();
		}
    }
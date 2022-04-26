<?php

    class Lab_model extends CI_Model
    {
        function getAllSamplesA($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
			}

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->where('lab.labId', 2);
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllSamplesB($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
			}

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->where('lab.labId', 3);
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllSamplesC($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
			}

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->where('lab.labId', 4);
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllSamplesD($limit, $start, $keyword = null)
        {
            if($keyword)
			{
				$this->db->like('orderdetail.noSample', $keyword);
			}

			$this->db->select('*, GROUP_CONCAT(DISTINCT noSample SEPARATOR "-") as Samples');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->where('lab.labId', 5);
			$this->db->group_by('order.orderId');
			$this->db->order_by('GROUP_CONCAT(DISTINCT noSample)', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

        function getSampleA($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 2);
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

		function getSampleB($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 3);
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

		function getSampleC($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 4);
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

		function getSampleD($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 5);
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

        function getCountSamplesA()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->like('lab.labId', 2);
			$this->db->like('order.statusId', 3);

			return $this->db->count_all_results();
		}

		function getCountSamplesB()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->like('lab.labId', 3);
			$this->db->like('order.statusId', 3);

			return $this->db->count_all_results();
		}

		function getCountSamplesC()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->like('lab.labId', 4);
			$this->db->like('order.statusId', 3);

			return $this->db->count_all_results();
		}

		function getCountSamplesD()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->like('lab.labId', 5);
			$this->db->like('order.statusId', 3);

			return $this->db->count_all_results();
		}

        function getCountLhus()
		{
			$this->db->like('statusId', '1');
			$this->db->from('sample');

			return $this->db->count_all_results();
		}

    }
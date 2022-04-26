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

        function getSampleA($orderId)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 2);
            $this->db->where('orderdetail.orderId', $orderId);

			return $this->db->get();
        }

		function getSampleB($orderId)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 3);
            $this->db->where('orderdetail.orderId', $orderId);

			return $this->db->get();
        }

		function getSampleC($orderId)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 4);
            $this->db->where('orderdetail.orderId', $orderId);

			return $this->db->get();
        }

		function getSampleD($orderId)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId', 'left');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('lab', 'parameter.labId=lab.labId', 'left');
			$this->db->join('sample', 'orderdetail.noSample=sample.noSample', 'left');
			$this->db->where('lab.labId', 5);
            $this->db->where('orderdetail.orderId', $orderId);

			return $this->db->get();
        }

        function getCountSamplesA()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 2);
			$this->db->where('order.statusId', 3);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

		function getCountSamplesB()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 3);
			$this->db->where('order.statusId', 3);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

		function getCountSamplesC()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 4);
			$this->db->where('order.statusId', 3);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

		function getCountSamplesD()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 5);
			$this->db->where('order.statusId', 3);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

        function getCountLhusA()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 2);
			$this->db->where('order.statusId', 4);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

		function getCountLhusB()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 3);
			$this->db->where('order.statusId', 4);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

		function getCountLhusC()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 4);
			$this->db->where('order.statusId', 4);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

		function getCountLhusD()
		{
			$this->db->select('orderdetail.orderId, orderdetail.parameterId');
			$this->db->from('orderdetail');
			$this->db->join('order', 'orderdetail.orderId=order.orderId','left');
			$this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId','left');
			$this->db->join('lab', 'parameter.labId=lab.labId','left');
			$this->db->where('lab.labId', 5);
			$this->db->where('order.statusId', 4);
			$this->db->group_by('orderdetail.orderId');

			return $this->db->count_all_results();
		}

    }
<?php

    class Lab_model extends CI_Model
    {
		function getLab()
		{
			$this->db->select('*');
			$this->db->from('lab');
			$this->db->join('employee', 'employee.empId=lab.empId', 'left');

			return $this->db->get()->result();
		}

        function getAllSamplesA($limit, $start, $keyword = null)
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
			$this->db->group_by('orderdetail.noSample');
			$this->db->where('package.packageId', 'A');
            $this->db->order_by('orderdetail.noSample', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllSamplesB($limit, $start, $keyword = null)
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
			$this->db->group_by('orderdetail.noSample');
			$this->db->where('package.packageId', 'B');
            $this->db->order_by('orderdetail.noSample', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllSamplesC($limit, $start, $keyword = null)
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
			$this->db->group_by('orderdetail.noSample');
			$this->db->where('package.packageId', 'C');
            $this->db->order_by('orderdetail.noSample', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

		function getAllSamplesD($limit, $start, $keyword = null)
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
			$this->db->group_by('orderdetail.noSample');
			$this->db->where('package.packageId', 'D');
            $this->db->order_by('orderdetail.noSample', 'desc');
			$this->db->limit($limit, $start);

			return $this->db->get()->result();
        }

        function getSampleA($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
			$this->db->where('package.packageId', 'A');
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

		function getSampleB($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
			$this->db->where('package.packageId', 'B');
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

		function getSampleC($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
			$this->db->where('package.packageId', 'C');
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

		function getSampleD($orderId, $noSample)
        {
            $this->db->select('*');
			$this->db->from('orderdetail');
            $this->db->join('parameter', 'orderdetail.parameterId=parameter.parameterId', 'left');
			$this->db->join('package', 'parameter.packageId=package.packageId', 'left');
			$this->db->where('package.packageId', 'D');
            $this->db->where('orderdetail.orderId', $orderId);
			$this->db->where('orderdetail.noSample', $noSample);

			return $this->db->get();
        }

        function getCountSamplesA()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->like('parameterId', 'A');
			$this->db->where('result', '');
			$this->db->group_by('noSample');

			return $this->db->count_all_results();
		}

		function getCountSamplesB()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->like('parameterId', 'B');
			$this->db->where('result', '');
			$this->db->group_by('noSample');

			return $this->db->count_all_results();
		}

		function getCountSamplesC()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->like('parameterId', 'C');
			$this->db->where('result', '');
			$this->db->group_by('noSample');

			return $this->db->count_all_results();
		}

		function getCountSamplesD()
		{
			$this->db->select('*');
			$this->db->from('orderdetail');
			$this->db->like('parameterId', 'D');
			$this->db->where('result', '');
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
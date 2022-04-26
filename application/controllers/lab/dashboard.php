<?php

class Dashboard extends CI_Controller
{
    function __construct()
	{
		parent:: __construct();

		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Anda belum login<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			
			redirect('auth');
		}
	}

    function index()
    {
        $data = $this->user_model->getDataUser($this->session->userdata['empId']);
		$data = array
				(
					'empName'=>$data->empName,
					'roleName'=>$data->roleName,
					'labName' => $data->labName
				);
		
		$data['countSampA'] = $this->lab_model->getCountSamplesA();
		$data['countSampB'] = $this->lab_model->getCountSamplesB();
		$data['countSampC'] = $this->lab_model->getCountSamplesC();
		$data['countSampD'] = $this->lab_model->getCountSamplesD();

		$data['countLhusA'] = $this->lab_model->getCountLhusA();
		$data['countLhusB'] = $this->lab_model->getCountLhusB();
		$data['countLhusC'] = $this->lab_model->getCountLhusC();
		$data['countLhusD'] = $this->lab_model->getCountLhusD();

		if($this->input->post('submit'))
		{
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		}
		else
		{
			$data['keyword'] = $this->session->userdata('keyword');
		}
					
		$this->db->like('noSample', $data['keyword']);
		$this->db->from('orderdetail');
		$this->db->group_by('orderId');
					
		$config['base_url'] = 'http://localhost/talab/lab/dashboard/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 30;
					
		$this->pagination->initialize($config);
					
		$data['start'] = $this->uri->segment(4);
		$data['viewOrdersA'] = $this->lab_model->getAllSamplesA($config['per_page'], $data['start'], $data['keyword']);
		$data['viewOrdersB'] = $this->lab_model->getAllSamplesB($config['per_page'], $data['start'], $data['keyword']);
		$data['viewOrdersC'] = $this->lab_model->getAllSamplesC($config['per_page'], $data['start'], $data['keyword']);
		$data['viewOrdersD'] = $this->lab_model->getAllSamplesD($config['per_page'], $data['start'], $data['keyword']);
		

        $this->load->view('templates/header');
        $this->load->view('lab/sidebar');
        $this->load->view('lab/dashboard', $data);
        $this->load->view('templates/footer');
    }

	function input($orderId)
	{
		$data = $this->user_model->getDataUser($this->session->userdata['empId']);
		$data = array
				(
					'labName' => $data->labName
				);

		$data['viewSampleA'] = $this->lab_model->getSampleA($orderId)->result();
		$data['viewSampleB'] = $this->lab_model->getSampleB($orderId)->result();
		$data['viewSampleC'] = $this->lab_model->getSampleC($orderId)->result();
		$data['viewSampleD'] = $this->lab_model->getSampleD($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('lab/sidebar');
        $this->load->view('lab/result', $data);
        $this->load->view('templates/footer');
	}

	function inputResult($orderId)
	{
		$this->_rules();

        if($this->form_validation->run() == FALSE)
        {
            $this->input($orderId);
        }
        else
        {
			$employess = $this->session->userdata('empId');
			$orderId = $this->input->post('orderId');
			$noSamples = $this->input->post('noSample');
			$noSample = explode(', ', $noSamples);
			$parameterIds = $this->input->post('parameterId');
			$parameterId = explode(', ', $parameterIds);

			$results = $this->input->post('result');
			$testTime = $this->input->post('testTime');

			$combined = array_combine($parameterId, $results);

			//$this->db->trans_start();

			foreach($noSample as $no)
			{
				foreach($combined as $parameterId => $results)
				{
					$this->db->set('result', $results);
					$this->db->set('testTime', $testTime);
					$this->db->set('empId', $employess);
					$this->db->where('orderId', $orderId);
					$this->db->where('noSample', $no);
					$this->db->where('parameterId', $parameterId);
					$this->db->update('orderdetail');
				}
			}

            $where = array('orderId' => $orderId);

			$tableOrder = array(
				'statusId' => 4
			);
			$this->order_model->updateDataOrder($where, 'order', $tableOrder);
			
			//$this->db->trans_complete();
			//return $this->db->trans_status();
			
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil disimpan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('lab/dashboard');
		}
	}

	function _rules()
    {
		$this->form_validation->set_rules('result[]','Hasil','required',['required'=>'Data harus diisi']);
		$this->form_validation->set_rules('testTime','Tanggal Uji','required',['required'=>'Data harus diisi']);
    }
}
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
					'roleName'=>$data->roleName
				);
		
		$data['viewOrders'] = $this->sample_model->getDataOrders()->result();

        $this->load->view('templates/header');
        $this->load->view('sampling/sidebar');
        $this->load->view('sampling/dashboard', $data);
        $this->load->view('templates/footer');
    }

	function input($orderId)
	{
		$data['viewSample'] = $this->sample_model->getDataSamples($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('sampling/sidebar');
        $this->load->view('sampling/inputSample', $data);
        $this->load->view('templates/footer');
	}

	function inputSample($orderId)
	{	
		$orderId = $this->input->post('orderId');
		$noSamples = $this->input->post('noSample');
		$noSample = explode(', ', $noSamples);
		$sampleType = $this->input->post('type');
		$parameterIds = $this->input->post('parameterId');
		$parameterId = explode(', ', $parameterIds);

		foreach($noSample as $no)
		{
			$where = array('orderId' => $orderId, 'noSample' => $no);
		
			foreach($sampleType as $st)
			{
				$data = array('sampleType' => $st);
				$this->order_model->updateDataOrder($where, 'orderdetail', array
				(
					'sampleType' => $st
				));
			}
		}
		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('sampling/dashboard');
	}
}
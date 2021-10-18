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

		$data['viewClinical'] = $this->doctor_model->getDataCustomer()->result();
		$data['viewResult'] = $this->doctor_model->getTestResult()->result();
		
        $this->load->view('templates/header');
        $this->load->view('doctor/sidebar');
        $this->load->view('doctor/dashboard', $data);
        $this->load->view('templates/footer');
    }

	function input($orderId)
	{
		$data['updateClinical'] = $this->doctor_model->getDataClinical($orderId)->result();
		$data['lastSample'] = $this->db->query("SELECT noSample FROM testresult ORDER BY noSample DESC LIMIT 1")->result();
        
        $data['viewParameterA'] = $this->order_model->getParameterA()->result();
        $data['viewParameterB'] = $this->order_model->getParameterB()->result();
        $data['viewParameterC'] = $this->order_model->getParameterC()->result();
        $data['viewParameterD'] = $this->order_model->getParameterD()->result();

        $this->load->view('templates/header');
        $this->load->view('doctor/sidebar');
        $this->load->view('doctor/clinical', $data);
        $this->load->view('templates/footer');
	}

	function inputClinical($orderId)
	{
		
	}
}
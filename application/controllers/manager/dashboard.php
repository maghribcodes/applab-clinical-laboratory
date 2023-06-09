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
			
		$data['viewCountUsers'] = $this->manager_model->getCountEmployees();
		$data['viewCountParameters'] = $this->user_model->getCountParameters();

        $this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
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
		$this->load->view('templates/header');
        $this->load->view('reporting/sidebar');
        $this->load->view('reporting/dashboard');
        $this->load->view('templates/footer');
	}

}
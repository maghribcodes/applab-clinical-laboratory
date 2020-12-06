<?php

class Dashboard extends CI_Controller
{
    function __construct()
	{
		parent:: __construct();

		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">You are not login yet<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			
			redirect('auth'); //stay
		}
	}

    public function index()
    {
        $data = $this->user_model->getDataUser($this->session->userdata['username']);
		$data = array
				(
					'username'=>$data->username,
					'role'=>$data->role,
                );
                
        $this->load->view('templates/header');
        $this->load->view('cs/sidebar');
        $this->load->view('cs/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
<?php 

    class Clinical extends CI_Controller
    {
        function __construct()
        {
            parent:: __construct();

            if(!isset($this->session->userdata['username']))
            {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Anda belum login!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                
                redirect('auth');
            }

            $this->load->library('pdf');
        }

        function index()
        {
            $data['viewClinical'] = $this->order_model->getDataClinical()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/clinical', $data);
            $this->load->view('templates/footer');
        }
    }

?>
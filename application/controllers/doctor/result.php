<?php 

    class Result extends CI_Controller
    {
        function __construct()
        {
            parent:: __construct();

            if(!isset($this->session->userdata['username']))
            {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Anda belum login!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                
                redirect('auth');
            }
        }

        function index()
        {
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

            $config['base_url'] = 'http://localhost/talab/doctor/result/index';
            $config['total_rows'] = $this->db->count_all_results();
            $config['per_page'] = 4;

            $this->pagination->initialize($config);

            $data['start'] = $this->uri->segment(4);
            $data['viewResult'] = $this->doctor_model->getTestResult($config['per_page'], $data['start'], $data['keyword']);

            $this->load->view('templates/header');
            $this->load->view('doctor/sidebar');
            $this->load->view('doctor/result', $data);
            $this->load->view('templates/footer');
        }

        function verification($orderId)
        {
            $data['viewResult'] = $this->reporting_model->getTestResult($orderId)->result();
		    $data['viewParameter'] = $this->reporting_model->getParameters($orderId)->result();

            $this->load->view('templates/header');
            $this->load->view('doctor/sidebar');
            $this->load->view('doctor/verification', $data);
            $this->load->view('templates/footer');
        }

        function verified($orderId)
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE)
            {
                $this->verification($orderId);
            }
            else
            {
                $samples = $this->input->post('samples');
                $noSample = explode(', ', $samples);

                foreach($noSample as $no)
                {
                    $this->db->set('statusId', 2);
                    $this->db->where('noSample', $no);
                    $this->db->update('testresult');
                }

                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diverifikasi!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('doctor/result');
            }
        }

        function _rules()
        {
            $this->form_validation->set_rules('statusId','Status','required',['required'=>'Beri tanda check terlebih dahulu']);
        }
    }
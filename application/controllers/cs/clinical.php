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
        }

        function index()
        {
            $config['base_url'] = site_url('cs/clinical/index');
            $config['total_rows'] = $this->clinical_model->getDataClinical()->num_rows();
            $config['per_page'] = 5;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
    
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
    
            $this->pagination->initialize($config);
            //$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $from = $this->uri->segment(3);
    
            $data['viewClinical'] = $this->clinical_model->getDataPagination($config["per_page"], $from);
            $data['pagination'] = $this->pagination->create_links();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/clinical', $data);
            $this->load->view('templates/footer');
        }

        function input()
        {
            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/inputClinical');
            $this->load->view('templates/footer');
        }

        function inputClinical()
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE)
            {
                $this->input();
            }
            else
            {
                $employess = $this->session->userdata('empId');

                $tableCust = array(
                    'custName' => $this->input->post('custName'),
                    'birthDate' => $this->input->post('birthDate'),
                    'gender' => $this->input->post('gender'),
                    'contact' => $this->input->post('contact'),
                    'address' => $this->input->post('address'),
                );
                $input1=$this->clinical_model->inputDataClinical('customer', $tableCust);

                $tableOrder = array(
                    'custId' => $input1,
                    'empId' => $employess
                );
                $input2 = $this->clinical_model->inputDataClinical('order', $tableOrder);

                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('cs/clinical');
            }
        }

        function _rules()
        {
            $this->form_validation->set_rules('custName','custName','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('birthDate','birthDate','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('contact','contact','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('gender','gender','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('address','address','required',['required'=>'Data harus diisi']);
        }

        function update($custId)
        {
            $data['updateClinical'] = $this->clinical_model->getDataCustomer($custId)->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/updateClinical', $data);
            $this->load->view('templates/footer');
        }

        function updateClinical()
        {
            $employess = $this->session->userdata('empId');

            $custId = $this->input->post('custId');
            $where = array('custId' => $custId);
            $tableCust = array(
                'custName' => $this->input->post('custName'),
                'birthDate' => $this->input->post('birthDate'),
                'gender' => $this->input->post('gender'),
                'contact' => $this->input->post('contact'),
                'address' => $this->input->post('address'),
            );
            $this->clinical_model->updateDataClinical($where, 'customer', $tableCust);

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('cs/clinical');
        }

        function delete($orderId, $custId)
        {
            $where = array('orderId' => $orderId);
            $this->clinical_model->deleteDataClinical($where, 'order');

            $where = array('custId' => $custId);
            $this->clinical_model->deleteDataClinical($where, 'customer');

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('cs/clinical');
        }

        function search()
        {
            $keyword = $this->input->post('keyword');
			$data['searchClinical'] = $this->clinical_model->getKeyword($keyword)->result();

			$this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/searchClinical', $data);
            $this->load->view('templates/footer');
        }
    }

?>
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
            $data['viewClinical'] = $this->clinical_model->getDataClinical()->result();

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
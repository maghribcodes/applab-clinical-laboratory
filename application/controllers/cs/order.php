<?php

    class Order extends CI_Controller
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

        public function index()
        {
            $data['viewOrder'] = $this->order_model->getDataCustomer()->result();
            //$data['viewNota'] = $this->order_model->getDataNota()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/order', $data);
            $this->load->view('templates/footer');
        }

        public function input()
        {
            $data['viewParameterA'] = $this->order_model->getParameterA()->result();
            $data['viewParameterB'] = $this->order_model->getParameterB()->result();
            $data['viewParameterC'] = $this->order_model->getParameterC()->result();
            $data['viewParameterD'] = $this->order_model->getParameterD()->result();

            //$data['totalCost'] = $this->order_model->getTotalCost()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/input', $data);
            $this->load->view('templates/footer');
        }

        public function inputOrder()
        {
            $this->_rules();

            if($this->form_validation->run() == FALSE)
            {
                $this->input();
            }
            else
            {
                $employess = $this->session->userdata('empId');

                $samples = $this->input->post('noSample');
                $sample = explode(',', $samples);

                $parameters = $this->input->post('parameterId');

                //$data['totalCost'] = $this->order_model->getTotalCost()->result();

                $tableCust = array(
                    'custName'=>$this->input->post('custName'),
                    'birthDate'=>$this->input->post('birthDate'),
                    'contact'=>$this->input->post('contact'),
                    'gender'=>$this->input->post('gender'),
                    'address'=>$this->input->post('address'),
                );
                $input1=$this->order_model->inputDataOrder('customer',$tableCust);
                
                $tableNota = array(
                    'totalCost'=>$sum,
                    'empId'=>$employess,
                );
                $input2=$this->order_model->inputDataOrder('nota',$tableNota);

                $tableOrder = array(
                    'custId'=>$input1,
                    'notaId'=>$input2,
                    'sender'=>$this->input->post('sender'),
                );
                $input3=$this->order_model->inputDataOrder('order',$tableOrder);

                foreach($sample as $samp)
                {
                    $input4=$this->order_model->inputDataOrder('testresult', array
                    (
                        'noSample'=>$samp,
                        'empId'=>$employess
                    ));

                    foreach($parameters as $param)
                    {
                        $this->order_model->inputDataOrder('orderdetail', array
                        (
                            'orderId'=>$input3,
                            'noSample'=>$samp,
                            'parameterId'=>$param
                        ));
                    }
                }

                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('cs/order');
            }
        }

        public function _rules()
        {
            $this->form_validation->set_rules('noSample','noSample','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('custName','custName','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('birthDate','birthDate','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('contact','contact','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('gender','gender','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('address','address','required',['required'=>'Data harus diisi']);
        }

        public function update($orderId)
        {
            $data['updateOrder'] = $this->order_model->getDataOrder($orderId)->result();

            $data['viewParameterA'] = $this->order_model->getParameterA()->result();
            $data['viewParameterB'] = $this->order_model->getParameterB()->result();
            $data['viewParameterC'] = $this->order_model->getParameterC()->result();
            $data['viewParameterD'] = $this->order_model->getParameterD()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/update', $data);
            $this->load->view('templates/footer');
        }

        public function updateOrder()
        {
            $id = $this->input->post('orderId');

            $samples = $this->input->post('noSample');
            $sample = explode(',', $samples);

            $custName = $this->input->post('custName');
            $contact = $this->input->post('contact');
            $gender = $this->input->post('gender');
            $birthDate = $this->input->post('birthDate');
            $address = $this->input->post('address');

            $sender = $this->input->post('sender');

            $parameters = $this->input->post('parameterId');

            $tableCust = array(
                'custName' => $custName,
                'birthDate' => $birthDate,
                'contact' => $contact,
                'gender' => $gender,
                'address' => $address,
            );
            $this->order_model->updateDataOrder('customer', $tableCust);

            $tableOrder = array(
                'sender' => $sender
            );
            $this->order_model->updateDataOrder('order', $tableOrder, $where);

            foreach($sample as $samp)
            {
                $this->order_model->updateDataOrder('testresult', array
                (
                    'noSample'=>$samp
                ));

                foreach($parameters as $param)
                {
                    $this->order_model->updateDataOrder('orderdetail', $where, array
                    (
                        'noSample'=>$samp,
                        'parameterId'=>$param
                    ));
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('cs/order');
        }
    }
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

            $this->load->library('pdf');
        }

        public function index()
        {
            $data['viewOrder'] = $this->order_model->getDataCustomer()->result();

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
                $sample = explode(', ', $samples);

                $parameters = $this->input->post('parameterId');

                $tableCust = array(
                    'custName' => $this->input->post('custName'),
                    'birthDate' => $this->input->post('birthDate'),
                    'gender' => $this->input->post('gender'),
                    'contact' => $this->input->post('contact'),
                    'address' => $this->input->post('address'),
                );
                $input1=$this->order_model->inputDataOrder('customer', $tableCust);

                $getAllCost = $this->order_model->getAllParameters()->result();
                $cost = array();
                foreach($getAllCost as $gac)
                {
                    if($parameters != NULL)
                    {
                        if(in_array($gac->parameterId, $parameters))
                        {
                            $cost[] = $gac->parameterCost;
                            $total = array_sum($cost);
                        }
                    }
                    else
                    {
                        $total = 0;
                    }
                }
                
                $tableNota = array(
                    'totalCost' => $total,
                    'empId' => $employess,
                );
                $input2 = $this->order_model->inputDataOrder('nota', $tableNota);

                $tableOrder = array(
                    'custId' => $input1,
                    'notaId' => $input2,
                    'sender' => $this->input->post('sender'),
                );
                $input3 = $this->order_model->inputDataOrder('order', $tableOrder);

                foreach($sample as $samp)
                {
                    $input4 = $this->order_model->inputDataOrder('testresult', array
                    (
                        'noSample' => $samp,
                        'empId' => $employess
                    ));

                    foreach($parameters as $param)
                    {
                        $this->order_model->inputDataOrder('orderdetail', array
                        (
                            'orderId' => $input3,
                            'noSample'=> $samp,
                            'parameterId'=> $param
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

        public function nota($orderId)
        {
            $data['viewNota'] = $this->order_model->getDataNota($orderId)->result();
            $data['viewCost'] = $this->order_model->getAllParameters()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/nota', $data);
            $this->load->view('templates/footer');
        }

        public function printNota($orderId)
        {
            $data['printNota'] = $this->order_model->getDataNota($orderId)->result();
            $data['printCost'] = $this->order_model->getAllParameters()->result();

            $this->load->view('cs/print', $data);
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
            $this->order_model->updateDataOrder($where, 'customer', $tableCust);

            $orderId = $this->input->post('orderId');
            $where = array('orderId' => $orderId);
            $tableOrder = array(
                'sender' => $this->input->post('sender')
            );
            $this->order_model->updateDataOrder($where, 'order', $tableOrder);

            $notaId = $this->input->post('notaId');
            $updatedParameters = $this->input->post('parameterId');
            $where = array('notaId' => $notaId);
            $getAllCost = $this->order_model->getAllParameters()->result();
                $cost = array();
                foreach($getAllCost as $gac)
                {
                    if($updatedParameters != NULL)
                    {
                        if(in_array($gac->parameterId, $updatedParameters))
                        {
                            $cost[] = $gac->parameterCost;
                            $total = array_sum($cost);
                        }
                    }
                    else
                    {
                        $total = 0;
                    }
                }
            $tableNota = array(
                'totalCost'=>$total
            );
            $this->order_model->updateDataOrder($where, 'nota', $tableNota);

            $samples = $this->input->post('samples');
            $samplesExplode = explode(', ', $samples);

            $updatedSamples = $this->input->post('noSample');
            $updatedSamplesExplode = explode(', ', $updatedSamples);

            $checkSamples = $this->order_model->getAllSamples()->result();
            
            foreach($samplesExplode as $x)
            {
                foreach($updatedSamplesExplode as $y)
                {
                    if(in_array($y, $checkSamples))
                    {
                        $this->db->delete('orderdetail', array
                        (
                            'orderId' => $orderId,
                            'noSample' => $x
                        ));
                    }
                    else
                    {
                        if($y == NULL)
                        {
                            $this->db->delete('orderdetail', array
                            (
                                'orderId' => $orderId,
                                'noSample' => $x
                            ));

                            $this->db->delete('testresult', array
                            (
                                'noSample' => $x
                            ));
                        
                            $where = array('noSample' => $x);
                            $this->order_model->updateDataOrder($where, 'testresult', array
                            (
                                'noSample' => $y
                            ));
                        }
                        $this->order_model->inputDataOrder('testresult', array
                        (
                            'noSample' => $y,
                            'empId'=>$employess
                        ));
                    }
                }

                foreach($updatedParameters as $param)
                {
                    $this->order_model->inputDataOrder('orderdetail', array
                    (
                        'orderId' => $orderId,
                        'noSample' => $y,
                        'parameterId' => $param
                    ));
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('cs/order');
        }
    }
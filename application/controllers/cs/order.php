<?php

    class Order extends CI_Controller
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

            $config['base_url'] = 'http://localhost/talab/cs/order/index';
            $config['total_rows'] = $this->db->count_all_results();
            $config['per_page'] = 3;

            $this->pagination->initialize($config);

            $data['start'] = $this->uri->segment(4);
            $data['viewOrder'] = $this->order_model->getDataCustomer($config['per_page'], $data['start'], $data['keyword']);

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/order', $data);
            $this->load->view('templates/footer');
        }

        function input()
        {
            $data['viewParameterA'] = $this->order_model->getParameterA()->result();
            $data['viewParameterB'] = $this->order_model->getParameterB()->result();
            $data['viewParameterC'] = $this->order_model->getParameterC()->result();
            $data['viewParameterD'] = $this->order_model->getParameterD()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/inputOrder', $data);
            $this->load->view('templates/footer');
        }

        function inputOrder()
        {   
            $this->form_validation->set_rules('noSample','Nomor Sampel','callback_checkSamples');
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
        
                $tableOrder = array(
                    'custId' => $input1,
                    'sender' => $this->input->post('sender'),
                    'clinicalNotes' => $this->input->post('clinicalNotes'),
                    'totalCost' => $total,
                    'empId' => $employess
                );
                $input2 = $this->order_model->inputDataOrder('order', $tableOrder);
        
                foreach($sample as $samp)
                {
                    $this->order_model->inputDataOrder('testresult', array
                    (
                        'noSample' => $samp,
                        'empId' => $employess
                    ));
        
                    foreach($parameters as $param)
                    {
                        $this->order_model->inputDataOrder('orderdetail', array
                        (
                            'orderId' => $input2,
                            'noSample'=> $samp,
                            'parameterId'=> $param
                        ));
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('cs/order');
            }
        }

        function _rules()
        {
            $this->form_validation->set_rules('sender','Pengirim','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('custName','Nama Pasien','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('birthDate','Tanggal Lahir','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('contact','Kontak','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('gender','Jenis Kelamin','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('address','Alamat','required',['required'=>'Data harus diisi']);
            $this->form_validation->set_rules('parameterId[]','Parameter','callback_checkParameters');
        }

        function checkSamples($str)
        {
            if($str == NULL)
            {
                $this->form_validation->set_message('checkSamples', 'Data harus diisi');
                return FALSE;
            }
            else
            {
                $samples = explode(', ', $str);
                foreach($samples as $s)
                {
                    $query = $this->db->query("SELECT * FROM testresult WHERE noSample = '{$s}'");
                    $result = $query->result_array();
                    $count = count($result);

                    if($count > 0)
                    {
                        $this->form_validation->set_message('checkSamples', 'Nomor sampel sudah terdaftar');
                        return FALSE;
                    }
                    else
                    {
                        return TRUE;
                    }
                }
            }
        }

        function checkParameters($str)
        {
            if($str == NULL)
            {
                $this->form_validation->set_message('checkParameters', 'Data harus diisi');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }

        function nota($orderId)
        {
            $data['viewNota'] = $this->order_model->getDataOrder($orderId)->result();
            $data['viewCost'] = $this->order_model->getAllParameters()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/nota', $data);
            $this->load->view('templates/footer');
        }

        function printNota($orderId)
        {
            $data['printNota'] = $this->order_model->getDataOrder($orderId)->result();
            $data['printCost'] = $this->order_model->getAllParameters()->result();

            $this->load->view('cs/print', $data);
        }

        function update($orderId)
        {
            $data['updateOrder'] = $this->order_model->getDataOrder($orderId)->result();
        
            $data['viewParameterA'] = $this->order_model->getParameterA()->result();
            $data['viewParameterB'] = $this->order_model->getParameterB()->result();
            $data['viewParameterC'] = $this->order_model->getParameterC()->result();
            $data['viewParameterD'] = $this->order_model->getParameterD()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/updateOrder', $data);
            $this->load->view('templates/footer');
        }

        function updateOrder($orderId)
        {
            $oriSamples = $this->input->post('samples');
            $oriSample = explode(', ', $oriSamples);
            $newSamples = $this->input->post('noSample');
            $newSample = explode(', ', $newSamples);
            $validate = array_diff($oriSample, $newSample);

            foreach($validate as $v)
            {
                $is_unique =  '|is_unique[testresult.noSample]';
            }
            $is_unique =  '';
             
            $this->form_validation->set_rules('noSample', 'Nomor Sampel', 'required'.$is_unique, ['required'=>'Data harus diisi']);
            $this->_rules();

            if($this->form_validation->run() == FALSE)
            {
                $this->update($orderId);
            }
            else
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

                $updatedParameters = $this->input->post('parameterId');

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
                $tableOrder = array(
                    'sender' => $this->input->post('sender'),
                    'clinicalNotes' => $this->input->post('clinicalNotes'),
                    'totalCost' => $total
                );
                $this->order_model->updateDataOrder($where, 'order', $tableOrder);

                $samples = $this->input->post('samples');
                $samplesExplode = explode(', ', $samples);

                $updatedSamples = $this->input->post('noSample');
                $updatedSamplesExplode = explode(', ', $updatedSamples);

                $this->db->delete('orderdetail', array('orderId' => $orderId));

                foreach($updatedSamplesExplode as $y)
                {
                    $query = $this->db->query("SELECT * FROM testresult WHERE noSample = '{$y}'");
                    $result = $query->result_array();
                    $count = count($result);

                    if(empty($count))
                    {
                        $this->order_model->inputDataOrder('testresult', array
                        (
                            'noSample' => $y,
                            'empId' => $employess
                        ));
                    }
                    else if($count == 1)
                    {
                        $where = array('noSample' => $y);
                        $this->order_model->updateDataOrder($where, 'testresult', array
                        (
                            'noSample' => $y,
                            'empId' => $employess
                        ));
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

                $diff = array_diff($samplesExplode, $updatedSamplesExplode);
                foreach($diff as $d)
                {
                    $this->db->delete('testresult', array('noSample' => $d));
                }

                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('cs/order');
            }
        }

        function delete($orderId, $custId, $Samples)
        {
            $where = array('orderId' => $orderId);
            $this->order_model->deleteDataOrder($where, 'orderdetail');

            $where = array('orderId' => $orderId);
            $this->order_model->deleteDataOrder($where, 'order');

            $where = array('custId' => $custId);
            $this->order_model->deleteDataOrder($where, 'customer');

            $samplesExplode = explode('-', $Samples);

            foreach($samplesExplode as $se)
            {
                $where = array('noSample' => $se);
                $this->order_model->deleteDataOrder($where, 'testresult');
            }

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('cs/order');
        }
    }
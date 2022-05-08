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
            $config['per_page'] = 5;

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
            $this->form_validation->set_rules('sampleType','Tipe Sampel','callback_checkSamples');
            $this->_rules();

            if($this->form_validation->run() == FALSE)
            {
                $this->input();
            }
            else
            {
                $employess = $this->session->userdata('empId');

                $sampleTypes = $this->input->post('sampleType');
                $sampleType = explode(', ', $sampleTypes);

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
                    'empId' => $employess,
                    'statusId' => 2
                );
                $input2 = $this->order_model->inputDataOrder('order', $tableOrder);

                foreach($sampleType as $st)
                {
                    $new_id =  $this->order_model->get_idmax()->result();

                    if($new_id > 0) 
                    {
                        foreach ($new_id as $key) 
                        {
                            $auto_id = $key->noSample;              
                        }
                    }

                    $this->order_model->inputDataOrder('sample', array
                    (
                        'noSample' => $noSample = $this->order_model->get_newid($auto_id,'K.'),
                        'sampleType' => $st,
                        'empId' => $employess
                    ));
        
                    foreach($parameters as $param)
                    {
                        $this->order_model->inputDataOrder('orderdetail', array
                        (
                            'orderId' => $input2,
                            'noSample'=> $noSample = $this->order_model->get_newid($auto_id,'K.'),
                            'parameterId'=> $param,
                            'empId' => $employess
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
                return TRUE;
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
            $this->form_validation->set_rules('sampleType','Tipe Sampel','callback_checkUpdatedSamples');
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

                $updatedTypes = $this->input->post('sampleType');
                $updatedTypesExplode = explode(', ', $updatedTypes);

                $this->db->delete('orderdetail', array('orderId' => $orderId));
                
                $combined = array_combine($samplesExplode, $updatedTypesExplode);

                foreach($combined as $noSample => $sampleType)
                {
                    $this->db->set('sampleType', $sampleType);
                    $this->db->set('empId', $employess);
                    $this->db->where('noSample', $noSample);
                    $this->db->update('sample');

                    foreach($updatedParameters as $param)
                    {
                        $this->order_model->inputDataOrder('orderdetail', array
                        (
                            'orderId' => $orderId,
                            'noSample' => $noSample,
                            'parameterId' => $param,
                            'empId' => $employess
                        ));
                    }
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
                $this->order_model->deleteDataOrder($where, 'sample');
            }

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('cs/order');
        }

        function checkUpdatedSamples($str)
        {
            if($str == NULL)
            {
                $this->form_validation->set_message('checkUpdatedSamples', 'Data harus diisi');
                return FALSE;
            }
            else
            {
                $oriSamples = $this->input->post('types');
                $oriSample = explode(', ', $oriSamples);
                $newSample = explode(', ', $str);
                $validate = array_diff($newSample, $oriSample);

                $count1 = count($oriSample);
                $count2 = count($newSample);

                if($count1 == $count2)
                {
                    return TRUE;
                }
                else
                {
                    $this->form_validation->set_message('checkUpdatedSamples', 'Jumlah sampel tidak sesuai');
                    return FALSE;
                }
                return TRUE;
            }
        }

        function mail($orderId)
        {
            $data['viewOrder'] = $this->order_model->getDataOrder($orderId)->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/email', $data);
            $this->load->view('templates/footer');
        }

        function sendMail($orderId)
        {
            $this->form_validation->set_rules('email','Mail','required|valid_email',['required'=>'Data harus diisi']);
            
            if($this->form_validation->run() == FALSE)
            {
                $this->mail($orderId);
            }
            else
            {
                $custId = $this->input->post('custId');
                $where = array('custId' => $custId);
                $tableCust = array(
                    'email' => $this->input->post('email')
                );
                $this->order_model->updateDataOrder($where, 'customer', $tableCust);
                
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Disimpan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('cs/order');
            }
        }
    }
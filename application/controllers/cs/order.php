<?php

    class Order extends CI_Controller
    {
        public function index()
        {
            $data['viewOrder'] = $this->order_model->getDataOrder()->result();

            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/order', $data);
            $this->load->view('templates/footer');
        }

        public function input()
        {
            $this->load->view('templates/header');
            $this->load->view('cs/sidebar');
            $this->load->view('cs/input');
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
                $emp1=$this->session->userdata('empId');
                $checkbox = $this->input->post('parameter');
                $sum = $this->order_model->getTotalCost();

                $tableCust = array(
                    'custName'=>$this->input->post('custName'),
                    'birthDate'=>$this->input->post('birthDate'),
                    'contact'=>$this->input->post('contact'),
                    'gender'=>$this->input->post('gender'),
                    'address'=>$this->input->post('address'),
                );
                $input1=$this->order_model->inputDataOrder('customer',$tableCust);
                
                /*$tableNota = array(
                    'totalCost'=>$this->input->post('totalCost'),
                    'empId'=>$emp1,
                );
                $input2=$this->order_model->inputDataOrder('nota',$tableNota);*/

                $tableOrder = array(
                    'custId'=>$input1,
                    'notaId'=>$input2,
                    'sender'=>$this->input->post('sender'),
                    'clinicalNotes'=>$this->input->post('clinicalNotes'),
                );
                $input3=$this->order_model->inputDataOrder('order',$tableOrder);

                $tableTestResult = array(
                    'noSample'=>$this->input->post('noSample'),
                    'empId'=>$emp1,
                );
                $input4=$this->order_model->inputDataOrder('testresult',$tableTestResult);
                
                foreach($checkbox as $check)
                {
                    $this->order_model->inputDataOrder('orderdetail', array
                    (
                        'orderId'=>$input3,
                        'noSample'=>$this->input->post('noSample'),
                        'parameterId'=>$check
                    ));

                    if($sum->num_rows()>0)
                    {
                        $this->order_model->inputDataOrder('nota', array
                        (
                            'totalCost'=>$sum,
                            'empId'=>$emp1,
                        ));
                    }
                    else{

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
    }
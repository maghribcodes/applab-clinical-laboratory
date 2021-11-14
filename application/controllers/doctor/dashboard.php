<?php

class Dashboard extends CI_Controller
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

    function index()
    {
        $data = $this->user_model->getDataUser($this->session->userdata['empId']);
		$data = array
				(
					'empName'=>$data->empName,
					'roleName'=>$data->roleName
				);

		$data['viewClinical'] = $this->doctor_model->getDataCustomer()->result();
        $data['countClinical'] = $this->doctor_model->getCountClinical();
        $data['countLhus'] = $this->doctor_model->getCountLhus();
		
        $this->load->view('templates/header');
        $this->load->view('doctor/sidebar');
        $this->load->view('doctor/dashboard', $data);
        $this->load->view('templates/footer');
    }

	function input($orderId)
	{
		$data['updateClinical'] = $this->doctor_model->getDataClinical($orderId)->result();
		$data['lastSample'] = $this->db->query("SELECT noSample FROM testresult ORDER BY noSample DESC LIMIT 1")->result();
        
        $data['viewParameterA'] = $this->order_model->getParameterA()->result();
        $data['viewParameterB'] = $this->order_model->getParameterB()->result();
        $data['viewParameterC'] = $this->order_model->getParameterC()->result();
        $data['viewParameterD'] = $this->order_model->getParameterD()->result();

        $this->load->view('templates/header');
        $this->load->view('doctor/sidebar');
        $this->load->view('doctor/clinical', $data);
        $this->load->view('templates/footer');
	}

	function inputClinical($orderId)
	{
		$this->form_validation->set_rules('noSample','Nomor Sampel','callback_checkSamples');
        $this->_rules();

        if($this->form_validation->run() == FALSE)
        {
            $this->input($orderId);
        }
        else
        {
			$empId = $this->session->userdata('empId');
            $empName = $this->session->userdata('empName');

            $samples = $this->input->post('noSample');
            $sample = explode(', ', $samples);

            $parameters = $this->input->post('parameterId');
        
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

            $orderId = $this->input->post('orderId');
            $where = array('orderId' => $orderId);
			$tableOrder = array(
				'sender' => $empName,
				'totalCost' => $total,
                'clinicalNotes' => $this->input->post('clinicalNotes'),
				'empId' => $empId
			);
			$this->order_model->updateDataOrder($where, 'order', $tableOrder);
        
            foreach($sample as $samp)
            {
                $this->order_model->inputDataOrder('testresult', array
                (
                    'noSample' => $samp,
                    'empId' => $empId
                ));
        
                foreach($parameters as $param)
                {
                    $this->order_model->inputDataOrder('orderdetail', array
                    (
                        'orderId' => $this->input->post('orderId'),
                        'noSample'=> $samp,
                        'parameterId'=> $param
                    ));
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data klinisi sudah diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('doctor/dashboard');
		}
	}

	function _rules()
    {
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
                $length = strlen($s);
                if($length == 5)
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
                else
                {
                    $this->form_validation->set_message('checkSamples', 'Penulisan Nomor sampel tidak sesuai');
                    return FALSE;
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
}
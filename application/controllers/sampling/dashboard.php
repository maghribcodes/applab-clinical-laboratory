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
		
		$data['viewOrders'] = $this->sample_model->getDataOrders()->result();

        $this->load->view('templates/header');
        $this->load->view('sampling/sidebar');
        $this->load->view('sampling/dashboard', $data);
        $this->load->view('templates/footer');
    }

	function input($orderId)
	{
		$data['viewSample'] = $this->sample_model->getDataSamples($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('sampling/sidebar');
        $this->load->view('sampling/inputSample', $data);
        $this->load->view('templates/footer');
	}

	function inputSample($orderId)
	{	
        $this->_rules();

        if($this->form_validation->run() == FALSE)
        {
            $this->input($orderId);
        }
        else
        {
			$orderId = $this->input->post('orderId');
			$noSamples = $this->input->post('noSample');
			$noSample = explode(', ', $noSamples);

			$sampleTypes = $this->input->post('type');

			$parameterIds = $this->input->post('parameterId');
			$parameterId = explode(', ', $parameterIds);

			$units = $this->input->post('unit');
			$references = $this->input->post('reference');

			$combined1 = array_combine($noSample, $sampleTypes);
			$combined2 = array_combine($parameterId, $units);
			$combined3 = array_combine($parameterId, $references);

			//$this->db->trans_start();
			foreach($combined1 as $noSample => $sampleTypes)
			{
				$this->db->set('sampleType', $sampleTypes);
				$this->db->where('orderId', $orderId);
				$this->db->where('noSample', $noSample);
				$this->db->update('orderdetail');
				
				foreach($combined2 as $parameterId => $units)
				{
					$this->db->set('unit', $units);
					$this->db->where('orderId', $orderId);
					$this->db->where('noSample', $noSample);
					$this->db->where('parameterId', $parameterId);
					$this->db->update('orderdetail');
				}

				foreach($combined3 as $parameterId => $references)
				{
					$this->db->set('reference', $references);
					$this->db->where('orderId', $orderId);
					$this->db->where('noSample', $noSample);
					$this->db->where('parameterId', $parameterId);
					$this->db->update('orderdetail');
				}
			}	
			//$this->db->trans_complete();
			//return $this->db->trans_status();
			
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('sampling/dashboard');
		}
	}

	function _rules()
    {
        $this->form_validation->set_rules('type[]','Tipe sampel','required',['required'=>'Data harus diisi']);
		$this->form_validation->set_rules('unit[]','Satuan','required',['required'=>'Data harus diisi']);
		$this->form_validation->set_rules('reference[]','Nilai rujukan','required',['required'=>'Data harus diisi']);
    }
}
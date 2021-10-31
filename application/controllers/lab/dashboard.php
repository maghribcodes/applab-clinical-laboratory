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
		
		$data['countSamp'] = $this->lab_model->getCountSamples();
		$data['countLhus'] = $this->lab_model->getCountLhus();
		
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
					
		$config['base_url'] = 'http://localhost/talab/lab/dashboard/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 30;
					
		$this->pagination->initialize($config);
					
		$data['start'] = $this->uri->segment(4);
		$data['viewOrders'] = $this->lab_model->getAllSamples($config['per_page'], $data['start'], $data['keyword']);
		

        $this->load->view('templates/header');
        $this->load->view('lab/sidebar');
        $this->load->view('lab/dashboard', $data);
        $this->load->view('templates/footer');
    }

	function input($orderId)
	{
		$data['viewSample'] = $this->lab_model->getSample($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('lab/sidebar');
        $this->load->view('lab/result', $data);
        $this->load->view('templates/footer');
	}

	function inputResult($orderId)
	{
		$this->_rules();

        if($this->form_validation->run() == FALSE)
        {
            $this->input($orderId);
        }
        else
        {
			$orderId = $this->input->post('orderId');
			$noSample = $this->input->post('noSample');
			$parameterIds = $this->input->post('parameterId');
			$parameterId = explode(', ', $parameterIds);

			$methods = $this->input->post('method');
			$results = $this->input->post('result');

			$combined2 = array_combine($parameterId, $methods);
			$combined3 = array_combine($parameterId, $results);

			//$this->db->trans_start();

			foreach($combined2 as $parameterId => $methods)
			{
				$this->db->set('method', $methods);
				$this->db->where('orderId', $orderId);
				$this->db->where('noSample', $noSample);
				$this->db->where('parameterId', $parameterId);
				$this->db->update('orderdetail');
			}

			foreach($combined3 as $parameterId => $results)
			{
				$this->db->set('result', $results);
				$this->db->where('orderId', $orderId);
				$this->db->where('noSample', $noSample);
				$this->db->where('parameterId', $parameterId);
				$this->db->update('orderdetail');
			}

			$this->db->set('statusId', 1);
			$this->db->where('noSample', $noSample);
			$this->db->update('testresult');
			
			//$this->db->trans_complete();
			//return $this->db->trans_status();
			
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('lab/dashboard');
		}
	}

	function _rules()
    {
        $this->form_validation->set_rules('method[]','Metode','required',['required'=>'Metode harus diisi']);
		$this->form_validation->set_rules('result[]','Hasil','required',['required'=>'Hasil harus diisi']);
    }

	function detail($orderId)
	{
		$data['viewSample'] = $this->lab_model->getSample($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('lab/sidebar');
        $this->load->view('lab/detail', $data);
        $this->load->view('templates/footer');
	}
}
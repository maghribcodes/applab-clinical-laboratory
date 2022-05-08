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
		
		$data['countSamp'] = $this->sample_model->getCountSamples();

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
			
		$config['base_url'] = 'http://localhost/talab/sampling/dashboard/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 2;
			
		$this->pagination->initialize($config);
			
		$data['start'] = $this->uri->segment(4);
		$data['viewOrders'] = $this->sample_model->getDataOrders($config['per_page'], $data['start'], $data['keyword']);

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
			$employess = $this->session->userdata('empId');
			$noSamples = $this->input->post('noSample');
			$noSample = explode(', ', $noSamples);

			$sampleTypes = $this->input->post('type');

			$combined = array_combine($noSample, $sampleTypes);

			//$this->db->trans_start();
			foreach($combined as $noSample => $sampleTypes)
			{
				$this->db->set('sampleType', $sampleTypes);
				$this->db->set('empId', $employess);
				$this->db->where('noSample', $noSample);
				$this->db->update('sample');
			}

			$orderId = $this->input->post('orderId');
            $where = array('orderId' => $orderId);

			$tableOrder = array(
				'statusId' => 3
			);
			$this->order_model->updateDataOrder($where, 'order', $tableOrder);

			//$this->db->trans_complete();
			//return $this->db->trans_status();
			
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil disimpan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('sampling/dashboard');
		}
	}

	function _rules()
    {
        $this->form_validation->set_rules('type[]','Tipe sampel','required',['required'=>'Tipe sampel harus diisi']);
		$this->form_validation->set_rules('statusId','Status','required',['required'=>'Beri tanda check terlebih dahulu']);
    }
}
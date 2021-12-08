<?php

class Parameter extends CI_Controller
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
        if($this->input->post('submit'))
		{
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		}
		else
		{
			$data['keyword'] = $this->session->userdata('keyword');
		}
			
		$this->db->like('parameterName', $data['keyword']);
		$this->db->from('parameter');
			
		$config['base_url'] = 'http://localhost/talab/manager/parameter/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 10;
			
		$this->pagination->initialize($config);
			
		$data['start'] = $this->uri->segment(4);
		$data['viewParameters'] = $this->manager_model->getAllParameters($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/parameter', $data);
		$this->load->view('templates/footer');
    }

	function add()
	{
		$data['viewPackages'] = $this->manager_model->getPackages()->result();

		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/addParameter', $data);
        $this->load->view('templates/footer');
	}

	function addParameter()
	{
		$tableParam = array(
			'parameterName' => $this->input->post('parameterName'),
			'unit' => $this->input->post('unit'),
			'referenceValue' => $this->input->post('referenceValue'),
			'method' => $this->input->post('method'),
			'parameterCost' => $this->input->post('parameterCost'),
			'packageId' => $this->input->post('packageId')
		);
		$this->manager_model->inputData('parameter', $tableParam);

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/parameter');
	}

	function edit($parameterId)
	{	
		$data['viewParam'] = $this->manager_model->getParam($parameterId)->result();
		$data['viewPackages'] = $this->manager_model->getPackages()->result();

		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/editParameter', $data);
		$this->load->view('templates/footer');
	}

	function editParameter($parameterId)
	{
		$parameterId = $this->input->post('parameterId');
        $where = array('parameterId' => $parameterId);
        $tableParam = array(
            'parameterName' => $this->input->post('parameterName'),
            'unit' => $this->input->post('unit'),
            'referenceValue' => $this->input->post('referenceValue'),
            'method' => $this->input->post('method'),
            'parameterCost' => $this->input->post('parameterCost'),
            'packageId' => $this->input->post('packageId')
        );
        $this->manager_model->updateData($where, 'parameter', $tableParam);

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/parameter');
	}

	function delete($parameterId)
	{
		$where = array('parameterId' => $parameterId);
        $this->manager_model->deleteData($where, 'parameter');

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/parameter');
	}
	
}
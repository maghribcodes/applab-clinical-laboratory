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
		$config['per_page'] = 4;
			
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
		$data['idA'] = $this->manager_model->getLastIdA()->result();
		$data['idB'] = $this->manager_model->getLastIdB()->result();
		$data['idC'] = $this->manager_model->getLastIdC()->result();
		$data['idD'] = $this->manager_model->getLastIdD()->result();

		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/addParameter', $data);
        $this->load->view('templates/footer');
	}

	function addParameter()
	{
		if($this->input->post('role') == "A")
		{
			$tableParam = array(
				'parameterId' => $this->input->post('idA'),
				'parameterName' => $this->input->post('parameterName'),
				'unit' => $this->input->post('unit'),
				'reference' => $this->input->post('reference'),
				'method' => $this->input->post('method'),
				'parameterCost' => $this->input->post('parameterCost'),
				'packageId' => $this->input->post('role')
			);
			$this->manager_model->inputData('parameter', $tableParam);
		}
		else if($this->input->post('role') == "B")
		{
			$tableParam = array(
				'parameterId' => $this->input->post('idB'),
				'parameterName' => $this->input->post('parameterName'),
				'unit' => $this->input->post('unit'),
				'reference' => $this->input->post('reference'),
				'method' => $this->input->post('method'),
				'parameterCost' => $this->input->post('parameterCost'),
				'packageId' => $this->input->post('role')
			);
			$this->manager_model->inputData('parameter', $tableParam);
		}
		else if($this->input->post('role') == "C")
		{
			$tableParam = array(
				'parameterId' => $this->input->post('idC'),
				'parameterName' => $this->input->post('parameterName'),
				'unit' => $this->input->post('unit'),
				'reference' => $this->input->post('reference'),
				'method' => $this->input->post('method'),
				'parameterCost' => $this->input->post('parameterCost'),
				'packageId' => $this->input->post('role')
			);
			$this->manager_model->inputData('parameter', $tableParam);
		}
		else if($this->input->post('role') == "D")
		{
			$tableParam = array(
				'parameterId' => $this->input->post('idD'),
				'parameterName' => $this->input->post('parameterName'),
				'unit' => $this->input->post('unit'),
				'reference' => $this->input->post('reference'),
				'method' => $this->input->post('method'),
				'parameterCost' => $this->input->post('parameterCost'),
				'packageId' => $this->input->post('role')
			);
			$this->manager_model->inputData('parameter', $tableParam);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil disimpan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/parameter');
	}

	function edit($parameterId)
	{	
		$data['viewParam'] = $this->manager_model->getParam($parameterId)->result();
		$data['viewPackages'] = $this->manager_model->getPackages()->result();
		$data['idA'] = $this->manager_model->getLastIdA()->result();
		$data['idB'] = $this->manager_model->getLastIdB()->result();
		$data['idC'] = $this->manager_model->getLastIdC()->result();
		$data['idD'] = $this->manager_model->getLastIdD()->result();

		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/editParameter', $data);
	}

	function editParameter($parameterId)
	{
		$parameterId = $this->input->post('parameterId');
        $where = array('parameterId' => $parameterId);
        $tableParam = array(
            'parameterName' => $this->input->post('parameterName'),
            'unit' => $this->input->post('unit'),
            'reference' => $this->input->post('reference'),
            'method' => $this->input->post('method'),
            'parameterCost' => $this->input->post('role'),
            'packageId' => $this->input->post('role')
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
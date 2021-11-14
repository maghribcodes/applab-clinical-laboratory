<?php

class Package extends CI_Controller
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
		$data['viewPackages'] = $this->manager_model->getPackages()->result();

        $this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/package', $data);
        $this->load->view('templates/footer');
    }

	function add()
	{
		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/addPackage');
        $this->load->view('templates/footer');
	}

	function addPackage()
	{
		$tablePack = array(
			'packageId' => $this->input->post('packageId'),
			'packageName' => $this->input->post('packageName')
		);
		$this->manager_model->inputData('package', $tablePack);

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil disimpan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/package');
	}

	function edit($packageId)
	{	
		$data['viewPackages'] = $this->manager_model->getPack($packageId)->result();

		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/editPackage', $data);
		$this->load->view('templates/footer');
	}

	function editPackage($packageId)
	{
		$packageId = $this->input->post('packageId');
        $where = array('packageId' => $packageId);
        $tablePack = array(
            'packageName' => $this->input->post('packageName')
        );
        $this->manager_model->updateData($where, 'package', $tablePack);

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/package');
	}

	function delete($packageId)
	{
		$where = array('packageId' => $packageId);
        $this->manager_model->deleteData($where, 'package');

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manager/package');
	}
}
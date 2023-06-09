<?php

class Approval extends CI_Controller
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
			
		$this->db->like('custName', $data['keyword']);
		$this->db->from('customer');
			
		$config['base_url'] = 'http://localhost/talab/manager/approval/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 3;
			
		$this->pagination->initialize($config);
			
		$data['start'] = $this->uri->segment(4);
        $data['viewResult'] = $this->manager_model->getAllTestResult($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/result', $data);
        $this->load->view('templates/footer');
    }

	function approval($orderId)
	{
		$data['viewResult'] = $this->reporting_model->getTestResult($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('manager/sidebar');
        $this->load->view('manager/approval', $data);
        $this->load->view('templates/footer');
	}

	function approved($orderId)
	{
		$this->_rules();

        if($this->form_validation->run() == FALSE)
        {
            $this->approval($orderId);
        }
        else
        {
			$orderId = $this->input->post('orderId');
            $where = array('orderId' => $orderId);

			$tableOrder = array(
				'statusId' => 6
			);
			$this->order_model->updateDataOrder($where, 'order', $tableOrder);

            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Disetujui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('manager/approval');
        }
	}

	function _rules()
    {
        $this->form_validation->set_rules('statusId','Status','required',['required'=>'Beri tanda check terlebih dahulu']);
    }
}
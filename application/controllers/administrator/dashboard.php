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
		
		$data['countEmp'] = $this->admin_model->getCountEmployees();
		
        if($this->input->post('submit'))
		{
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		}
		else
		{
			$data['keyword'] = $this->session->userdata('keyword');
		}
			
		$this->db->like('empName', $data['keyword']);
		$this->db->from('employee');
			
		$config['base_url'] = 'http://localhost/talab/administrator/dashboard/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 3;
			
		$this->pagination->initialize($config);
			
		$data['start'] = $this->uri->segment(4);
		$data['viewStaff'] = $this->admin_model->getAllEmployee($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header');
        $this->load->view('administrator/sidebar');
        $this->load->view('administrator/dashboard', $data);
        $this->load->view('templates/footer');
    }
	
	function add()
	{
		$data['viewRoles'] = $this->admin_model->getRoles()->result();

		$this->load->view('templates/header');
        $this->load->view('administrator/sidebar');
        $this->load->view('administrator/addStaff', $data);
	}

	function addStaff()
	{
		$tableEmp = array(
			'empName' => $this->input->post('empName'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'roleId' => $this->input->post('role')
		);
		$empId = $this->admin_model->inputData('employee', $tableEmp);

		if($this->input->post('role') == 5)
		{
			$tableLab = array(
				'empId' => $empId,
				'packageId' => $this->input->post('lab')
			);
			$this->admin_model->inputData('lab', $tableLab);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil disimpan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('administrator/dashboard');
	}

	function edit($empId)
	{
		$data['viewEmp'] = $this->admin_model->getEmp($empId)->result();
		$data['viewRoles'] = $this->admin_model->getRoles()->result();
		$data['viewPackages'] = $this->admin_model->getPackages()->result();
		$data['viewLab'] = $this->admin_model->getLab($empId)->result();

		$this->load->view('templates/header');
        $this->load->view('administrator/sidebar');
        $this->load->view('administrator/editStaff', $data);
	}

	function editStaff($empId)
	{
		$empId = $this->input->post('empId');
        $where = array('empId' => $empId);
        $tableEmp = array(
            'empName' => $this->input->post('empName'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'roleId' => $this->input->post('role')
        );
        $this->admin_model->updateData($where, 'employee', $tableEmp);

		$query = $this->db->query("SELECT * FROM lab WHERE empId = '{$empId}'");
        $result = $query->result_array();
        $count = count($result);

		if($this->input->post('role') == 5)
		{
            if(empty($count))
            {
                $tableLab = array(
					'empId' => $empId,
					'packageId' => $this->input->post('lab')
				);
				$this->admin_model->inputData('lab', $tableLab);
            }
            else if($count == 1)
            {
                $where = array('empId' => $empId);
                $this->admin_model->updateData($where, 'lab', array
                (
                    'empId' => $empId,
                    'packageId' => $this->input->post('lab')
                ));
            }
		}
		else
		{
			if($count > 0)
			{
				$this->db->delete('lab', array('empId' => $empId));
			}
		}

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil diperbaharui!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('administrator/dashboard');
	}

	function delete($empId)
	{
		$query = $this->db->query("SELECT * FROM lab WHERE empId = '{$empId}'");
        $result = $query->result_array();
        $count = count($result);

		if($count > 0)
        {
			$this->db->delete('lab', array('empId' => $empId));
		}

		$where = array('empId' => $empId);
        $this->admin_model->deleteData($where, 'employee');

		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('administrator/dashboard');
	}
}
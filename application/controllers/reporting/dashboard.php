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
		$this->load->library('pdf');
	}

	function index()
	{
		$data = $this->user_model->getDataUser($this->session->userdata['empId']);
		$data = array
				(
					'empName'=>$data->empName,
					'roleName'=>$data->roleName
				);

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
			
		$config['base_url'] = 'http://localhost/talab/reporting/dashboard/index';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 3;
			
		$this->pagination->initialize($config);
			
		$data['start'] = $this->uri->segment(4);
		$data['viewOrders'] = $this->reporting_model->getAllCustomers($config['per_page'], $data['start'], $data['keyword']);

		$this->load->view('templates/header');
        $this->load->view('reporting/sidebar');
        $this->load->view('reporting/dashboard', $data);
        $this->load->view('templates/footer');
	}

	function print($orderId)
	{
		$data['printResult'] = $this->reporting_model->getTestResult($orderId)->result();
		$data['printParameter'] = $this->reporting_model->getParameters($orderId)->result();

        $this->load->view('reporting/print', $data);
	}

	function send($orderId)
	{
		$data['printResult'] = $this->reporting_model->getTestResult($orderId)->result();
		$data['printParameter'] = $this->reporting_model->getParameters($orderId)->result();

		$this->load->view('reporting/download', $data);
	}

	function mail($orderId)
	{
		$data['subject'] = "Laporan Hasil Uji";
		$data['viewResult'] = $this->reporting_model->getTestResult($orderId)->result();

		$this->load->view('templates/header');
        $this->load->view('reporting/sidebar');
        $this->load->view('reporting/email', $data);
        $this->load->view('templates/footer');
	}

	function sendMail()
	{
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		if(!empty($email))
		{
			$config = [
				'mailType' => 'text',
				'charset' => 'iso-8859-1',
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_user' => 'labkes2021@gmail.com',
				'smtp_pass' => 'Talab2020',
				'smtp_port' => 465
			];

			$config['newline'] = "\r\n";

			$this->load->library('email', $config);
			$this->email->initialize($config);

			$this->email->from('labkes2021@gmail.com');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send())
			{
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data berhasil dikirim!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('reporting/dashboard');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
		}
	}
}
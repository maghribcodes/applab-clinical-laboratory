<?php

    class Auth extends CI_Controller
    {
        public function index()
        {
            $this->load->view('login');
        }

        public function login()
        {
            $this->form_validation->set_rules('username', 'username', 'required',['required'=>'Masukkan username Anda']);
            $this->form_validation->set_rules('password', 'password', 'required',['required'=>'Masukkan password Anda']);

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('login');
            }
            else
            {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

				$user = $username;
                $pass = $password;
                
                $verify = $this->login_model->verifyLogin($user, $pass);

                if($verify->num_rows()>0)
			    {	
				    //session for username and role
                    foreach ($verify->result() as $ver)
                    {
						$session_data['empId'] = $ver->empId;
					    $session_data['username'] = $ver->username;
					    $session_data['role'] = $ver->role;

					    $this->session->set_userdata($session_data); //call session
				    }
				    if($session_data['role']=='Admin')
				    {
					    redirect('admin/dashboard');
				    }
				    else if($session_data['role']=='Customer Service')
				    {
					    redirect('cs/dashboard');
				    }
				    else if($session_data['role']=='Doctor Consulent')
				    {
					    redirect('doctor/dashboard');
				    }
				    else if($session_data['role']=='Sampling Staff')
				    {
					    redirect('sampling/dashboard');
				    }
				    else if($session_data['role']=='Lab Staff')
				    {
					    redirect('lab/dashboard');
				    }
				    else if($session_data['role']=='Reporting Staff')
				    {
					    redirect('reporting/dashboard');
				    }
				    else
				    {
					$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Username atau password tidak sesuai<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('auth');
				    }
			    }
			    else
			    {
				    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Username atau password tidak sesuai<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				    redirect('auth');
                }
            }
        }

        public function logout()
	    {
		    $this->session->sess_destroy();
		    redirect('auth');
        }
    
    }
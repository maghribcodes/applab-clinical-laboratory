<?php

    class Login_model extends CI_Model
    {
	    public function verifyLogin($username, $password)
	    {
		    $this->db->where('username', $username);
		    $this->db->where('password', $password);

		    return $this->db->get('employee');
	    }

	    public function getLoginData($user, $pass)
	    {
		    $u = $user;
		    $p = $pass;

		    $query_verifyLogin = $this->db->get_where('employee', array('username'=>$u, 'password'=>$p));

		    //verify compatibility data for employee
		    if(count($query_verifyLogin->result())>0)
		    {
			    foreach ($query_verifyLogin->result() as $qvl)
			    {
				    foreach ($query_verifyLogin->result() as $ver)
				    {
					    $session_data['logged_in'] = TRUE;
						$session_data['empId'] = $ver->empId;
					    $session_data['username'] = $ver->username;
					    $session_data['password'] = $ver->password;
					    $session_data['role'] = $ver->role;

					    $this->session->set_userdata($session_data); //call session
				    }
				    redirect('cs/dashboard');
			    }	
		    }
		    else
		    {
			    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Username atau password tidak sesuai<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			    redirect('auth');
		    }
	    }
    }
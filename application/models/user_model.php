<?php

    class User_model extends CI_Model
    {
	    public function getDataUser($id)
	    {
		    $this->db->where('username', $id);
		    return $this->db->get('employee')->row();
	    }
    }
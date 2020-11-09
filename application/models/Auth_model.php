<?php

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function set_user()
    {
        //$this->load->helper('url');
        // подготовим данные
        //профильтруем массив телефонных номеров и сохраним их в JSON
        $arrPhone_in = $this->input->post('phone');
        $arrPhone = array();
        foreach ($arrPhone_in as $value) {
            if (strlen($value) > 0) $arrPhone[] = $value;
        }
        $phoneJson = json_encode($arrPhone);


        $data = array(
            'login' => $this->input->post('login'),
            'password' => md5($this->input->post('password')),
            'full_name' => $this->input->post('full_name'),
            'birth_date' => $this->input->post('birth_date'),
            'position' => $this->input->post('position'),
            'phone' => $phoneJson,
            'created_data' => date('Y-m-d')
        );

        return $this->db->insert('users', $data);
    }

    public function check_user($login)
    {
        $query = $this->db->get_where('users', array('login' => $login));
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_pas()
    {
        $login = ($this->input->post('login_in'));
        $password = md5($this->input->post('password_in'));

        $query = $this->db->get_where('users', array('login' => $login));
        $result = $query->row_array();
        if ($result['password'] === $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

<?php

class User_model extends CI_Model
{


    public function get_user()
    {
        $query = $this->db->get_where('users', array('login' => $_SESSION['login']));
        $result = $query->row_array();
        return $result;
    }

    public function update_user()
    {

        $login = $_SESSION['login'];

        // подготовим данные
        //профильтруем массив телефонных номеров и сохраним их в JSON
        $arrPhone_in = $this->input->post('phone');
        $arrPhone = array();
        foreach ($arrPhone_in as $value) {
            if (strlen($value) > 0) {
                $arrPhone[] = $value;
            }
        }
        $phoneJson = json_encode($arrPhone);

        $password = $this->input->post('password');
        if (strlen($password) === 0) {
            $data = array(
                'login' => $this->input->post('login'),
                'full_name' => $this->input->post('full_name'),
                'birth_date' => $this->input->post('birth_date'),
                'position' => $this->input->post('position'),
                'phone' => $phoneJson
            );
        } else {
            $data = array(
                'login' => $this->input->post('login'),
                'password' => md5($this->input->post('password')),
                'full_name' => $this->input->post('full_name'),
                'birth_date' => $this->input->post('birth_date'),
                'position' => $this->input->post('position'),
                'phone' => $phoneJson
            );
        }

        $this->db->where('login', $login);
        $this->db->update('users', $data);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['logged_in'])) {
            $this->session->set_flashdata("error_log", "Сначало надо зарегестрироваться");
            redirect("auth");
        }
    }

    public function index()
    {

        $this->load->helper('form');

        $this->load->model('user_model');
        $data = $this->user_model->get_user();
        // устанавливеам титул
        $data['title'] = "Профиль";
        // вытаскиваем телефонные номера в JSON и переводим в массив для отправки
        $data['arrPhone'] =  json_decode($data['phone']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {

        $this->load->helper('form');

        $this->load->model('user_model');
        $data = $this->user_model->get_user();
        // устанавливеам титул
        $data['title'] = "Редактирование профиля";
        // вытаскиваем телефонные номера в JSON и переводим в массив для отправки
        $data['arrPhone'] =  json_decode($data['phone']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('user/update', $data);
        $this->load->view('templates/footer');
    }

    public function update_set()
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_message('required', 'Поле %s не заполнено');
        $this->form_validation->set_message('min_length', '{field} должен быть длиной не менее {param} символов.');
        $this->form_validation->set_message('max_length', '{field} должен быть длиной не более {param} символов.');

        $password = $this->input->post('password');
        if (strlen($password) === 0) // eсли пароль не ввели, то его мы не проверяем и не записываем в базу далее
        {
            $this->form_validation->set_rules(
                'login',
                'Логин',
                array('trim', 'required', 'min_length[5]', 'max_length[12]'),
                array(
                    'required'      => 'Ты не ввел  %s дружище.',
                    'is_unique'     => 'Пользователь с таким логином уже существует, введите другой логин.'
                )
            );
            // можно проверить и другие поля

            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Редактирование профиля";
                echo "No";
                // load view
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('user/update', $data);
                $this->load->view('templates/footer');
            } else {

                $this->load->model('user_model');
                $this->user_model->update_user();

                $this->session->set_flashdata("success", "Поздравляем! Вы успешно отредактировали профиль!");
                // меняем значение сессии
                $newdata = array(
                    'login'  => $this->input->post('login'),
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);

                redirect("user/update");
            }
        } else {
            $this->form_validation->set_rules(
                'login',
                'Логин',
                array('trim', 'required', 'min_length[5]', 'max_length[12]'),
                array(
                    'required'      => 'Ты не ввел  %s дружище.',
                    'is_unique'     => 'Пользователь с таким логином уже существует, введите другой логин.'
                )
            );
            //array('login_callable', array($this->users_model, 'valid_username'))
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]|max_length[30]', array('required' => 'Ты не ввел  %s дружище.'));
            $this->form_validation->set_rules('password2', 'Потверждение пароля', 'matches[password]',  array('matches' => 'Не совпадают пароли.'));

            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Редактирование профиля";

                // load view
                $this->load->view('templates/header', $data);
                $this->load->view('templates/nav');
                $this->load->view('user/update', $data);
                $this->load->view('templates/footer');
            } else {

                $this->load->model('user_model');
                $this->user_model->update_user();

                $this->session->set_flashdata("success", "Поздравляем! Вы успешно отредактировали профиль!");

                // меняем значение сессии
                $newdata = array(
                    'login'  => $this->input->post('login'),
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);

                redirect("user/update");
            }
        }
    }
}

<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->load->helper('form');

        $data['title'] = "Вход";

        $this->load->view('templates/header', $data);
        $this->load->view('auth/index');
        $this->load->view('templates/footer');
    }

    public function registerr()
    {
    }
    public function register()
    {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_message('required', 'Поле %s не заполнено');
        $this->form_validation->set_message('min_length', '{field} должен быть длиной не менее {param} символов.');
        $this->form_validation->set_message('max_length', '{field} должен быть длиной не более {param} символов.');
        $this->form_validation->set_rules(
            'login',
            'Логин',
            array('trim', 'required', 'min_length[5]', 'max_length[12]', 'is_unique[users.login]'),
            array(
                'required'      => 'Ты не ввел  %s дружище.',
                'is_unique'     => 'Пользователь с таким логином уже существует, введите другой логин.'
            )
        );
        //array('login_callable', array($this->users_model, 'valid_username'))
        $this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]|max_length[30]', array('required' => 'Ты не ввел  %s дружище.'));
        $this->form_validation->set_rules('password2', 'Потверждение пароля', 'required|matches[password]',  array('matches' => 'Не совпадают пароли.'));

        // телефонные номера проверять не буду, так как не полный номер отправить через фронт не возможно, но можно отправить пустые поля, перед записю в базу данных отсеим их в модели

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Регистрация";
            $data['active_reg'] = 'active';  // это переменная для активации класса формы регистрации 
            // load view
            $this->load->view('templates/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->load->model('auth_model');
            $this->auth_model->set_user();

            $this->session->set_flashdata("success", "Вы успешно зарегестрирвоались в личном кабинете!");

            // устанавливаем значение сессии
            $newdata = array(
                'login'  => $this->input->post('login'),
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            redirect("user", "refresh");
        }
    }

    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_message('required', 'Поле %s не заполнено');
        $this->form_validation->set_rules('login_in', 'Логин', 'required|callback_username_check');
        $this->form_validation->set_rules('password_in', 'Пароль', 'required');


        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Вход";
            $data['active_in'] = 'active';  // это переменная для активации класса формы входа на странице
            //load view
            $this->load->view('templates/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->auth_model->check_pas()) {
                $newdata = array(
                    'login'  => $this->input->post('login_in'),
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($newdata);
                redirect("user", "refresh");
            } else {
                $this->session->set_flashdata("error", "Не верный пароль");

                $data['title'] = "Вход";
                $data['active_in'] = 'active';  // это переменная для активации класса формы входа на странице
                //load view
                $this->load->view('templates/header', $data);
                $this->load->view('auth/index', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function username_check($str)
    {
        $this->load->model('auth_model');

        if ($this->auth_model->check_user($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('username_check', 'Пользователя с таким логином не существует');
            return FALSE;
        }
    }

    public function logout()
    {
        session_destroy();
        redirect("auth", "refresh");
    }
}

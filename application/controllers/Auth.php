<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function index()
    {
        $this->auth->beforeLogin();
        $data = [];
        $this->load->view('v_login', $data);
    }

    public function login()
    {
        $this->auth->beforeLogin();
        $post = $this->input->post();

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_login');
        } else {

            $data = [
                'username' => $post['username'],
                'password' => $post['password'],
            ];

            $this->auth->login($data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('notif', '<div class="alert alert-danger">Silahkan login kembali!</div>');
        redirect(base_url('auth'));
    }
}

/* End of file Auth.php and path \application\controllers\Auth.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_login");
        $this->load->library('session');
		if (is_logged()) {
			redirect(base_url('dashboard'));
			return;
		}
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view("login");
        $this->load->view('templates/footer');
    }

    public function cek() {
        if($this->input->method(TRUE) == 'POST' && !empty($_POST)) {
            $in['username'] = $this->input->post('username');
            $in['password'] = ($this->input->post('password'));
            echo $this->M_login->cek($in);
        }else {
            redirect(base_url());
        }
    }

}

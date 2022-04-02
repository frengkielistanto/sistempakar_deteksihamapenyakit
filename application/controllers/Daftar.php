<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_daftar");
        $this->load->database();
		if (is_logged()) {
			redirect(base_url('dashboard'));
			return;
		}
    }

    public function index()   
                           
    {
        $this->load->view('templates/header');
        $this->load->view("daftar");
        $this->load->view('templates/footer');
    }

    public function tambah_aksi() 
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $nama       = $this->input->post('nama');

        $data = array (
            
            'username'     => $username,
            'password'     => $password,
            'nama'         => $nama,
        );

        $this->m_daftar->input_data($data, 'tb_user');
        redirect('login');
        echo "<script>
                    alert('Data Berhasil Ditambahkan');
                    window.location='".site_url('login')."';
                </script>";
    }
}

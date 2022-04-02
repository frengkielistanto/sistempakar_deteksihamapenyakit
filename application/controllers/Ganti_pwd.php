<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ganti_pwd extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_ganti_pwd");
        $this->load->library('form_validation');
    }
    public function index()
	{

		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('ganti_password/ganti');
		$this->load->view('templates/footer');
	}
    public function gantipwd()
    {
     
      $this->load->database(); 
      $this->load->library('form_validation','url','session');
        $this->form_validation->set_rules(
            'password_baru',
            'Password Baru',
            'trim'
        );
        $this->form_validation->set_rules(
            'ulangi',
            'Password Baru',
            'trim|matches[password_baru]',
            array('matches' => '%s tidak sama')
        );
        $this->form_validation->set_rules(
            'password',
            'Password Lama',
            'callback_cek_password_lama'
        );

        if ($this->form_validation->run() === FALSE) {
         
          $data = array(
                      'title' => 'Ubah Password', 
                      'isi' => 'ganti_password/ganti',                          
                  );

                  $this->load->view('templates/header');
                  $this->load->view('templates/sidebar');
                  $this->load->view('ganti_password/ganti',$data);
                  $this->load->view('templates/footer');
                  
       } else {
                  $this->M_ganti_pwd->update_password($this->session->userdata('userdata')['id_user']);
                  $this->session->set_flashdata('sukses', '<div class="alert bg-success" role="alert">Password berhasil diubah</div>');
                  redirect('ganti_pwd/gantipwd');
              }
    }
    public function cek_password_lama($password)
    { 
      $query = $this->M_ganti_pwd->cek_password_lama($this->session->userdata('userdata')['id_user'],$password); 
      if ($query->num_rows() == 0) {
          $this->form_validation->set_message('cek_password_lama', '{field} salah');
          return FALSE;
          
      } else {
          return TRUE;
      }
    }
}

/* End of file Controllername.php */

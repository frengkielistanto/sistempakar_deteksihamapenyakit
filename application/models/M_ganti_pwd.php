<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ganti_pwd extends CI_Model {

    public function cek_password_lama($id_user,$password)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('password', ($password));
        return $this->db->get('tb_user');
    }
    
    public function update_password($id_user)
    {
        $data = array(
            'password' => ($this->input->post('password_baru'))
        );
        $this->db->where('id_user', $id_user);
        return $this->db->update('tb_user', $data);
    }

}

/* End of file ModelName.php */

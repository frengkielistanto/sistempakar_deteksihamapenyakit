<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model
{
    public function cek($in){
        $username = $in['username'];
		$password = $in['password'];

        $user =  $this->db->query("SELECT username, id_user, password, nama as nama, id_user FROM tb_user WHERE username='$username' AND password='$password'");
        if ($user->num_rows() > 0) {
			foreach ($user->result() as $data) {
				$session['username'] = $data->username;
				$session['id_user'] = $data->id_user;
				$session['nama'] = $data->nama;
				$this->session->set_userdata('userdata', $session);
				$this->session->set_userdata('is_login', $session);
			}
			echo "<script>
                    alert('Login Berhasil');
                    window.location='".site_url('dashboard')."';
                </script>";
            }else {
                echo "<script>
                        alert('Login Gagal, Pastikan username atau password terisi benar!');
                        window.location='".site_url('login')."';
                    </script>";
            }
        }
    }

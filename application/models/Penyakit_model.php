<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit_model extends CI_Model
{
    private $_table = "info_penyakit";

    public $kode;
    public $nama_pkt;
    public $jenis;
    public $solusi;

    public function rules($type='simpan')
    {
        return [
            ['field' => 'kode',
            'label' => 'Kode',
            'rules' => $type=='simpan'?'required|trim|is_unique[info_penyakit.kode]':'',
            
            'errors'=> [
                'required'=> 'data tidak boleh kosong',
                'is_unique'=> 'data tidak boleh sama'
            ]],

            ['field' => 'nama_pkt',
            'label' => 'Nama_pkt',
            'rules' => $type=='simpan'?'required|trim|is_unique[info_penyakit.nama_pkt]':'required',
            
            'errors'=> [
                'required'=> 'data tidak boleh kosong',
                'is_unique'=> 'data tidak boleh sama'
            ]],

            ['field' => 'jenis',
            'label' => 'Jenis',
            'rules' => 'required'],
            
            ['field' => 'solusi',
            'label' => 'Solusi',
            'rules' => 'required',
            'errors'=> [
                'required'=> 'data tidak boleh kosong',
                'is_unique'=> 'data tidak boleh sama'
            ]],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kode" => $id])->row();
    }
    public function get_product_keyword($keyword){
        $this->db->select('*');
        $this->db->from('info_penyakit');
        $this->db->like('nama_pkt',$keyword);
        //$this->db->or_like('harga',$keyword);
        return $this->db->get()->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kode = $post["kode"];
        $this->nama_pkt = $post["nama_pkt"];
        $this->jenis = $post["jenis"];
        $this->solusi = $post["solusi"];
        return $this->db->insert($this->_table, $this);

    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->kode = $id;
        $this->nama_pkt = $post["nama_pkt"];
        $this->jenis = $post["jenis"];
        $this->solusi = $post["solusi"];
        return $this->db->update($this->_table, $this, array('kode' => $id));

    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kode" => $id));
    }
    public function get($id=null, $limit = 5, $offset = 0)
    {
        if($id===null){
            return $this->db->get('info_penyakit', $limit, $offset)->result();   
        }else{
            return $this->db->get_where('info_penyakit', ['kode' => $id])->result_array();
        }
    }
    // public function count(){
    //     return $this->db->get('info_gejala')->num_rows();
    // }
    public function add($data)
    {
        try {
        $cek=$this->db->get_where('info_penyakit', ['kode' => $data['kode']])->row_array();
        if($cek){
            return ['status' => false, 'code'=> 400 , 'msg' => 'Data sudah ada'];
        }
        $this->db->insert('info_penyakit', $data);
        $error = $this->db->error();
        if (!empty($error['code'])){
            throw new Exception('Terjadi kesalahan: ' . $error['message']);
            return false;
        }
        return['status' => true, 'data' => $this->db->affected_rows()];
        }catch (Exception $ex) {
            return ['status' => false, 'code'=> 500 , 'msg' => $ex->getMessage()];
        }
    }

    public function update_api($id, $data)
    {
        try {
        $cek=$this->db->get_where('info_penyakit', ['kode' => $data['kode']])->row_array();
        if($cek&&$cek['id'] != $id){
            return ['status' => false, 'code'=> 400 , 'msg' => 'Data sudah ada'];
        }
        $this->db->update('info_penyakit', $data,  ["id" => $id] );
        $error = $this->db->error();
        if (!empty($error['code'])){
            throw new Exception('Terjadi kesalahan: ' . $error['message']);
            return false;
        }
        return['status' => true, 'data' => $this->db->affected_rows()];
        }catch (Exception $ex) {
            return ['status' => false, 'code'=> 500 , 'msg' => $ex->getMessage()];
        }
    }
    public function delete_api($id)
    {
        try {
        $this->db->delete('info_penyakit',  ["id" => $id] );
        $error = $this->db->error();
        if (!empty($error['code'])){
            throw new Exception('Terjadi kesalahan: ' . $error['message']);
            return false;
        }
        return['status' => true, 'data' => $this->db->affected_rows()];
        }catch (Exception $ex) {
            return ['status' => false, 'code'=> 500 , 'msg' => $ex->getMessage()];
        }
    }
}
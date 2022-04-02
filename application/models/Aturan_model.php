<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aturan_model extends CI_Model
{
    private $_table = "aturan";

    
    public $gejala_id;
    public $penyakit_id;
    public $cf;
   
   

    public function rules()
    {
        return [
            ['field' => 'gejala_id',
            'label' => 'gejala_id',
            'rules' => 'required'],

            ['field' => 'penyakit_id',
            'label' => 'Penyakit_id',
            'rules' => 'required'],

            ['field' => 'cf',
            'label' => 'cf',
            'rules' => 'required',
            'errors'=> [
                'required'=> 'data tidak boleh kosong',
                'is_unique'=> 'data tidak boleh sama'
            ]],


            
        ];
    }
    public function join3table(){
      $this->db->select('aturan.*,info_gejala.nama_gjl,info_penyakit.nama_pkt');
      $this->db->from('aturan');
      $this->db->join('info_gejala','aturan.gejala_id = info_gejala.id','left');
      $this->db->join('info_penyakit',' aturan.penyakit_id = info_penyakit.id','left');      
      $query = $this->db->get();
      return $query;
   }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        // $post = $this->input->post();
        // $this->kode = $post["gejala_nama"];
        // $this->nama_gjl = $post["nama_gjl"];
        // return $this->db->insert($this->_table, $this);
        // print_r($post);
        
        $post = $this->input->post();
        $this->gejala_id= $post["gejala_id"];
        $this->penyakit_id = $post["penyakit_id"];
        $this->cf = $post["cf"];
    
        
        
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        
        $this->gejala_id= $post["gejala_id"];
        $this->penyakit_id = $post["penyakit_id"];
        $this->cf = $post["cf"];
        
        // $this->id = $post["id"];
        return $this->db->update($this->_table, $this, array('id' => $post['id']));

     
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
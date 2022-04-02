<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Aturan extends CI_Controller{
   
   public function __construct()
    {
        parent::__construct();

        $this->load->model("Aturan_model");
        $this->load->model("Gejala_model");
        $this->load->model("Penyakit_model");
        $this->load->library("form_validation");
    }
	public function index()
	{
	//    $data['info_gejala'] = $this->Aturan_model->data_info_gejala()->result(); 
	//    $data['info_penyakit'] = $this->Aturan_model->data_info_penyakit()->result(); 
	   $data['join_info_gejala_info_penyakit'] = $this->Aturan_model->join3table()->result(); 
	   $this->load->view('templates/header');
	    $this->load->view('templates/sidebar');
		$this->load->view('aturan/list',$data);
		$this->load->view('templates/footer');
	} 

	public function add()
    {
        $aturan = $this->Aturan_model;
        $data['gejala'] = $this->Gejala_model->getAll();
        $data['penyakit'] = $this->Penyakit_model->getAll();
        $validation = $this->form_validation;
        $validation->set_rules($aturan->rules());

        if ($validation->run()) {
            $aturan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            
        }
        // print_r(validation_errors());
        
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('aturan/new_form',$data);
		$this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('Aturan');
       
        $aturan = $this->Aturan_model;
        $data['gejala'] = $this->Gejala_model->getAll();
        $data['penyakit'] = $this->Penyakit_model->getAll();
        $validation = $this->form_validation;
        $validation->set_rules($aturan->rules());

        if ($validation->run()) {
            $aturan->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["aturan"] = $aturan->getById($id);
        if (!$data["aturan"]) show_404();
        //  echo json_encode($data);
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('aturan/edit_form', $data);
		$this->load->view('templates/footer');
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Aturan_model->delete($id)) {
            redirect(site_url('Aturan'));
        }
    }
}

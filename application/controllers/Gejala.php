<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Gejala extends CI_Controller {
 
	public function __construct()
    {
        parent::__construct();
        $this->load->model("Gejala_model");
        $this->load->library('form_validation');
    }
 
	public function index()
	{
		$data['gejala'] = $this->Gejala_model->getAll();
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('gejala/list',$data);
		$this->load->view('templates/footer');
	}
    public function search(){
        $keyword = $this->input->post('keyword');
        $data['gejala']=$this->Gejala_model->get_product_keyword($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('gejala/list',$data);
		$this->load->view('templates/footer');
    }
	public function add()
    {
        $gejala = $this->Gejala_model;
        $validation = $this->form_validation;
        $validation->set_rules($gejala->rules());

        if ($validation->run()) {
            $gejala->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('gejala/new_form');
		$this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('Gejala');
       
        $gejala= $this->Gejala_model;
        $validation = $this->form_validation;
        $validation->set_rules($gejala->rules('update'));

        if ($validation->run()) {
            $gejala->update($id);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }


        $data["gejala"] = $gejala->getById($id);
        if (!$data["gejala"]) show_404();
        
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('gejala/edit_form', $data);
		$this->load->view('templates/footer');
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Gejala_model->delete($id)) {
            redirect(site_url('Gejala'));
        }
    }
}
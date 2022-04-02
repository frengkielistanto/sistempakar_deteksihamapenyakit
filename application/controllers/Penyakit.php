<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Penyakit extends CI_Controller {
 
	public function __construct()
    {
        parent::__construct();
        $this->load->model("Penyakit_model");
        $this->load->library('form_validation');
    }
 
	public function index()
	{
		$data['penyakit'] = $this->Penyakit_model->getAll();
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('penyakit/list',$data);
		$this->load->view('templates/footer');
	}
    public function search(){
        $keyword = $this->input->post('keyword');
        $data['penyakit']=$this->Penyakit_model->get_product_keyword($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('penyakit/list',$data);
		$this->load->view('templates/footer');
    }
	public function add()
    {
        $penyakit = $this->Penyakit_model;
        $validation = $this->form_validation;
        $validation->set_rules($penyakit->rules());
      // $validation->set_rules('kode', 'kode', 'required|trim|is_unique[info_penyakit.kode]');
        if ($validation->run()) {
            $penyakit->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('penyakit/new_form');
		$this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('Penyakit');
       
        $penyakit = $this->Penyakit_model;
        $validation = $this->form_validation;
        $validation->set_rules($penyakit->rules('update'));

        if ($validation->run()) {
            $penyakit->update($id);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["penyakit"] = $penyakit->getById($id);
        if (!$data["penyakit"]) show_404();
        
		$this->load->view('templates/header');
        $this->load->view('templates/sidebar');
		$this->load->view('penyakit/edit_form', $data);
		$this->load->view('templates/footer');
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Penyakit_model->delete($id)) {
            redirect(site_url('Penyakit'));
        }
    }
}
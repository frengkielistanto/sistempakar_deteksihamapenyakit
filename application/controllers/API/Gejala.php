<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;
 
class Gejala extends RestController {
 
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Gejala_model','gjl');
        
    }
 
	public function index_get()
	{
        $id = $this->get('id');
        if($id===null){ 
            // $p = $this->get('page');
            // $p = (empty($p)? 1 : $p);
            // $total_data = $this->gjl->count();
            // $total_page = cell($total_data / 2);
            // $start = ($p - 1) * 2;
            // $list = $this->gjl->get(null, 10, $start);
            // $data=[
            //     'status' => true,
            //     'page' => $p,
            //     'total_data' => $total_data,
            //     'total_page' => $total_page,
            //     'data' => $list
            // ];
            //['status' => true, 'data' => $list]
            $list = $this->gjl->get();
            $this->response(['status' => true, 'data' => $list], RestController::HTTP_OK);
        }else{
            $data = $this->gjl->get($id);
            if($data){
                $this->response(['status' => true, 'data' => $data], RestController::HTTP_OK);    
            } else {
                $this->response(['status' => false, 'msg' => $id . 'tidak ditemukan'], RestController::HTTP_NOT_FOUND);    
            }    
        }
	}
    public function index_post()
    {
        $data = [
            'kode' => $this->post('kode'),
            'nama_gjl' => $this->post('nama_gjl')
        ];
        $simpan = $this->gjl->add($data);
        if ($simpan['status']){
            $this->response(['status' => true, 'msg' => $simpan['data'] . ' Data telah ditambahkan'], RestController::HTTP_CREATED); 
        } else {
            $this->response(['status' => false, 'msg' => $simpan['msg']], $simpan['code']);
        }
    }
    public function index_put()
    {

        $data = [
            'kode' => $this->put('kode'),
            'nama_gjl' => $this->put('nama_gjl')
        ];
        $id = $this->put('id');
        $simpan = $this->gjl->update_api($id, $data);
        if ($simpan['status']){
            $this->response(['status' => true, 'msg' => $simpan['data'] . ' Data telah dirubah'], RestController::HTTP_OK); 
        } else {
            $this->response(['status' => false, 'msg' => $simpan['msg']], $simpan['code']);
        }
    }
    public function index_delete(){
        $id = $this->delete('id');
        $delete = $this->gjl->delete_api($id);
        if ($delete['status']){
            $this->response(['status' => true, 'msg' => $id . ' Data telah dihapus'], RestController::HTTP_OK); 
        } else {
            $this->response(['status' => false, 'msg' => $deletei['msg']], $simpan['code']);
        }
    }
}
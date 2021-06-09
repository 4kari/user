<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Prodi extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Prodi_model','mprodi');
    }
    public function index_get(){
        $kode_prodi = $this->get('kode_prodi');
        if ($kode_prodi == null) {
            $Prodi = $this->mprodi->getProdi();
        } else{
            $Prodi = $this->mprodi->getProdi($kode_prodi);
        }
        if ($Prodi){
            $this->response([
                'status' => true,
                'data' =>$Prodi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){
        $kode_prodi = $this->delete('kode_prodi');
        if ($kode_prodi == null){
            $this->response([
                'status' => false,
                'message' => 'tambahkan id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mprodi->deleteProdi($kode_prodi)>0){
                //ok
                $this->response([
                    'status' => true,
                    'message' => 'terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }          
        }
    }
    public function index_post(){
        $data=[
            'kode_fakultas' => $this->post('kode_fakultas'),
            'kode_prodi' => $this->post('kode_prodi'),
            'prodi' => $this->post('prodi')
        ];
        
        if ($this->mprodi->createProdi($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Prodi baru ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put(){
        $kode_prodi=$this->put('kode_prodi');
        $data=[
            'kode_fakultas' => $this->put('kode_fakultas'),
            'kode_prodi' => $this->put('kode_prodi'),
            'prodi' => $this->put('prodi')
        ];

        if ($this->mprodi->updateProdi($data,$kode_prodi)>0){
            $this->response([
                'status' => true,
                'message' => 'Prodi telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Prodi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
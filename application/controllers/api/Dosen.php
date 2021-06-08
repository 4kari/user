<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Dosen extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Dosen_model','mdosen');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Dosen = $this->mdosen->getDosen();
        } else{
            $Dosen = $this->mdosen->getDosen($id);
        }
        if ($Dosen){
            $this->response([
                'status' => true,
                'data' =>$Dosen
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){
        $id = $this->delete('id');
        if ($id == null){
            $this->response([
                'status' => false,
                'message' => 'tambahkan id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mdosen->deleteDosen($id)>0){
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
            'id_post' => $this->post('id_post'),
            'waktu' => $this->post('waktu'),
            'pesan' => $this->post('pesan'),
            'tipe' => $this->post('tipe'),
            'pengirim' => $this->post('pengirim'),
            'file' => $this->post('file')
        ];
        
        if ($this->mdosen->createDosen($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Dosen baru ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put(){
        $id=$this->put('id');
        $data=[
            'id_post' => $this->put('id_post'),
            'waktu' => $this->put('waktu'),
            'pesan' => $this->put('pesan'),
            'tipe' => $this->put('tipe'),
            'pengirim' => $this->put('pengirim'),
            'file' => $this->put('file')
        ];

        if ($this->mdosen->updateDosen($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Dosen telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Dosen'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
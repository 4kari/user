<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Fakultas extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Fakultas_model','mfakultas');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Fakultas = $this->mfakultas->getFakultas();
        } else{
            $Fakultas = $this->mfakultas->getFakultas($id);
        }
        if ($Fakultas){
            $this->response([
                'status' => true,
                'data' =>$Fakultas
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
            if ($this->mfakultas->deleteFakultas($id)>0){
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
        
        if ($this->mfakultas->createFakultas($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Fakultas baru ditambahkan'
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

        if ($this->mfakultas->updateFakultas($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Fakultas telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Fakultas'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
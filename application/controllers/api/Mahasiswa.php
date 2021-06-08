<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Mahasiswa extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Mahasiswa_model','mhs');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Mahasiswa = $this->mhs->getMahasiswa();
        } else{
            $Mahasiswa = $this->mhs->getMahasiswa($id);
        }
        if ($Mahasiswa){
            $this->response([
                'status' => true,
                'data' =>$Mahasiswa
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
            if ($this->mhs->deleteMahasiswa($id)>0){
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
        
        if ($this->mhs->createMahasiswa($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Mahasiswa baru ditambahkan'
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

        if ($this->mhs->updateMahasiswa($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Mahasiswa telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Mahasiswa'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
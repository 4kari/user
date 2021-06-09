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
            'nim' => $this->post('nim'),
            'nama' => $this->post('nama'),
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'prodi' => $this->post('prodi'),
            'jenis_kelamin' => $this->post('jenis_kelamin'),
            'alamat' => $this->post('alamat'),
            'no_hp' => $this->post('no_hp'),
            'gambar' => $this->post('gambar'),
            'tanggal_lahir' => $this->post('tanggal_lahir'),
            'tanggal_buat' => $this->post('tanggal_buat')
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
        $id=$this->put('nim');
        $data=[
            'nim' => $this->put('nim'),
            'nama' => $this->put('nama'),
            'username' => $this->put('username'),
            'email' => $this->put('email'),
            'prodi' => $this->put('prodi'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'alamat' => $this->put('alamat'),
            'no_hp' => $this->put('no_hp'),
            'gambar' => $this->put('gambar'),
            'tanggal_lahir' => $this->put('tanggal_lahir'),
            'tanggal_buat' => $this->put('tanggal_buat')
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
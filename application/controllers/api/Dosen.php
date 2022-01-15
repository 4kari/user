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
        $nip = $this->get('nip');
        if ($nip == null) {
            $Dosen = $this->mdosen->getDosen();
        } else{
            $Dosen = $this->mdosen->getDosen($nip);
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
        $nip = $this->delete('nip');
        if ($nip == null){
            $this->response([
                'status' => false,
                'message' => 'tambahkan nip'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mdosen->deleteDosen($nip)>0){
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
            'nip' => $this->post('nip'),
            'nama' => $this->post('nama')
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
        $nip=$this->put('nip');
        $data=[
            'nip' => $this->put('nipbaru'),
            'nama' => $this->put('nama'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'alamat' => $this->put('alamat'),
            'tanggal_lahir' => $this->put('tanggal_lahir'),
            'no_hp' => $this->put('no_hp'),
            'gambar' => $this->put('gambar'),
            'username' => $this->put('username'),
            'prodi' => $this->put('prodi'),
            'email' => $this->put('email'),
            'tanggal_buat' => $this->put('tanggal_buat'),
            'beban' => $this->put('beban')
        ];

        if ($this->mdosen->updateDosen($data,$nip)>0){
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
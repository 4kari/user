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
        $kode = $this->get('kode');
        if ($kode == null) {
            $Fakultas = $this->mfakultas->getFakultas();
        } else{
            $Fakultas = $this->mfakultas->getFakultas($kode);
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
        $kode = $this->delete('kode_fakultas');
        if ($kode == null){
            $this->response([
                'status' => false,
                'message' => 'tambahkan kode fakultas'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mfakultas->deleteFakultas($kode)>0){
                //ok
                $this->response([
                    'status' => true,
                    'message' => 'terhapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'kode tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }          
        }
    }
    public function index_post(){
        $data=[
            'kode_fakultas' => $this->post('kode_fakultas'),
            'fakultas' => $this->post('fakultas')
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
        $kode=$this->put('kode_fakultas');
        $data=[
            'kode_fakultas' => $this->put('kode_fakultas'),
            'fakultas' => $this->put('fakultas')
        ];

        if ($this->mfakultas->updateFakultas($data,$kode)>0){
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
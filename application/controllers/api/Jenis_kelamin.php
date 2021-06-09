<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Jenis_kelamin extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Jenis_kelamin_model','mJK');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Jenis_kelamin = $this->mJK->getJenis_kelamin();
        } else{
            $Jenis_kelamin = $this->mJK->getJenis_kelamin($id);
        }
        if ($Jenis_kelamin){
            $this->response([
                'status' => true,
                'data' =>$Jenis_kelamin
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
            if ($this->mJK->deleteJenis_kelamin($id)>0){
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
            'jenis_kelamin' => $this->post('jenis_kelamin'),
        ];
        
        if ($this->mJK->createJenis_kelamin($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Jenis_kelamin baru ditambahkan'
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
            'jenis_kelamin' => $this->put('jenis_kelamin')
        ];

        if ($this->mJK->updateJenis_kelamin($data,$id)>0){
            $this->response([
                'status' => true,
                'message' => 'Jenis_kelamin telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui Jenis_kelamin'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
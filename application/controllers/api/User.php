<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class User extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model','muser');
    }
    public function index_get(){
        $username = $this->get('username');
        if ($username == null) {
            $User = $this->muser->getUser();
        } else{
            $User = $this->muser->getUser($username);
        }
        if ($User){
            $this->response([
                'status' => true,
                'data' =>$User
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){
        $username = $this->delete('username');
        if ($username == null){
            $this->response([
                'status' => false,
                'message' => 'tambahkan id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->muser->deleteUser($username)>0){
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
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'level' => $this->post('level')
        ];
        
        if ($this->muser->createUser($data)>0){
            $this->response([
                'status' => true,
                'message' => 'User baru ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put(){
        $username=$this->put('username');
        $data=[
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'level' => $this->post('level')
        ];

        if ($this->muser->updateUser($data,$username)>0){
            $this->response([
                'status' => true,
                'message' => 'User telah diperbarui'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal memperbarui User'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
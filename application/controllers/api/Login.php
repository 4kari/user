<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Login extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model','mLogin');
    }
    // public function index_get(){
    //     $data=[
    //         'username' => 170411100099,
    //         'password' => 170411100099
    //     ];
    //     $auth=$this->mLogin->cek_login($data);
    //     if ($auth){
    //         $this->response([
    //             'status' => true,
    //             'data' =>$auth,
    //             'message' => 'login berhasil'
    //         ], REST_Controller::HTTP_OK);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'data tidak ditemukan'
    //         ], REST_Controller::HTTP_NOT_FOUND);
    //     }
    // }

    public function index_post(){
        $data=[
            'username' => $this->post('username'),
            'password' => $this->post('password')
        ];
        $auth=$this->mLogin->cek_login($data);
        if ($auth){
            $this->response([
                'status' => true,
                'data' =>$auth,
                'message' => 'login berhasil'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
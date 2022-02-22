<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Password extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model','muser');
    }
    public function index_put(){
        $username=$this->put('username');
        $data=[
            'passworda' => $this->put('passworda'),
            'passwordb' => $this->put('passwordb'),
        ];

        if ($this->muser->updatePassword($data,$username)>0){
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
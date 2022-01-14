<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Level extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Level_model','mLevel');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id == null) {
            $Level = $this->mLevel->getLevel();
        } else{
            $Level = $this->mLevel->getLevel($id);
        }
        if ($Level){
            $this->response([
                'status' => true,
                'data' =>$Level
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // public function index_delete(){
    //     $id = $this->delete('id');
    //     if ($id == null){
    //         $this->response([
    //             'status' => false,
    //             'message' => 'tambahkan id'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     } else {
    //         if ($this->mLevel->deleteLevel($id)>0){
    //             //ok
    //             $this->response([
    //                 'status' => true,
    //                 'message' => 'terhapus'
    //             ], REST_Controller::HTTP_NO_CONTENT);
    //         }
    //         else{
    //             $this->response([
    //                 'status' => false,
    //                 'message' => 'id tidak ditemukan'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }          
    //     }
    // }
    // public function index_post(){
    //     $data=[
    //         'Level' => $this->post('Level'),
    //     ];
        
    //     if ($this->mLevel->createLevel($data)>0){
    //         $this->response([
    //             'status' => true,
    //             'message' => 'Level baru ditambahkan'
    //         ], REST_Controller::HTTP_CREATED);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'gagal menambahkan data baru'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
    // public function index_put(){
    //     $id=$this->put('id');
    //     $data=[
    //         'Level' => $this->put('Level')
    //     ];

    //     if ($this->mLevel->updateLevel($data,$id)>0){
    //         $this->response([
    //             'status' => true,
    //             'message' => 'Level telah diperbarui'
    //         ], REST_Controller::HTTP_NO_CONTENT);
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'gagal memperbarui Level'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}
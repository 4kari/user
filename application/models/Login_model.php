<?php
class Login_model extends CI_Model{
    public function cek_login($data){
        $username = $data['username'];
        $password = $data['password'];
        //hash password
        $data = $this->db->get_where('user', ['username' => $username])->row_array();
        $user=[];
        if ($data){
            if ($data['password']==$password){
                $user=[
                        'username' => $data['username'],
                        'level' => $data['level']
                    ];
            }
        }
        return $user;
    }
}
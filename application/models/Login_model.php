<?php
class Login_model extends CI_Model{
    public function cek_login($data){
        $username = $data['username'];
        $password = $data['password'];
        //hash password
        $data = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/User/',array('username'=>$username), array(CURLOPT_BUFFERSIZE => 10)),true)['data'][0];
        // $data = json_decode($this->curl->simple_get('http://10.5.12.26/user/api/User/',array('username'=>$username), array(CURLOPT_BUFFERSIZE => 10)),true)['data'];
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
<?php
class Login_model extends CI_Model{
    public function cek_login($data){
        $username = $data['username'];
        $password = $data['password'];
        //hash password
        $data = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/User/',array('username'=>$username), array(CURLOPT_BUFFERSIZE => 10)),true);
        $user=[];
        if ($data){
            if ($data['data']['password']==$password){
                $user=[
                        'username' => $data['data']['username'],
                        'level' => $data['data']['level']
                    ];
            }
        }
        return $user;
    }
}
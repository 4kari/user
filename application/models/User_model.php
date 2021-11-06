<?php
class User_model extends CI_Model{
    public function getUser($username=null){
        $data=[];
        if ($username === null){
            $data = $this->db->get('User')->result_array();
        } else {
            $data = $this->db->get_where('User', ['username' => $username])->result_array();
        }
        // $level = json_decode($this->curl->simple_get('http://10.5.12.26/user/api/Level/'),true)['data'];
        $level = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/Level/'),true)['data'];
        for ($i=0;$i<count($data);$i++){
            for ($j=0;$j<count($level);$j++){
                if ($data[$i]['level']==$level[$j]['id']){
                    $data[$i]['levelket']=$level[$j]['level'];
                }
            }
            if ($data[$i]['level']==3){
                $data[$i]['data_profil']=$this->db->get_where('dosen',['username' => $data[$i]['username']])->row_array();
            }
            elseif ($data[$i]['level']==4){
                $data[$i]['data_profil']=$this->db->get_where('mahasiswa',['username' => $data[$i]['username']])->row_array();
            }else{
                $data[$i]['data_profil']="kosong";
            }
        }
        return $data;
    }
    public function deleteUser($username){
        $this->db->delete('User', ['username' => $username]);
        return $this->db->affected_rows();
    }
    public function createUser($data){
        $this->db->insert('User',$data);
        return $this->db->affected_rows();
    }
    public function updateUser($data,$username){
        $this->db->update('User', $data, ['username' => $username]);
        return $this->db->affected_rows();
    }
}
?>
<?php
class Dosen_model extends CI_Model{
    public function getDosen($nip=null){
        if ($nip === null){
            return $this->db->get('Dosen')->result_array();
        } else {
            return $this->db->get_where('Dosen', ['nip' => $nip])->row_array();
        }
    }
    public function deleteDosen($nip){
        $this->db->delete('Dosen', ['nip' => $nip]);
        return $this->db->affected_rows();
    }
    public function createDosen($data){
        $nip = $data['nip'];
        $nama = $data['nama'];
        if($nip && $nama){
            // $user = json_decode($this->curl->simple_get('http://10.5.12.26/user/api/User/'),true);
            $user = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/User/',array('username' => $nip)),true);
            $cek=false;
            for ($i=0;$i<count($user);$i++){
                if($user['data'][$i]['username']==$nip){
                    $cek=true;
                }
            }
            if($cek==false){
                $data=[
                    'username'=>$nip,
                    'password'=>$nip,
                    'level'=>"3"
                ];
                // json_decode($this->curl->simple_post('http://10.5.12.26/user/api/user/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
                json_decode($this->curl->simple_post('http://localhost/microservice/user/api/user/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
            }
            $dosen = $this->getDosen($nip);
            if ($dosen==NULL){
                $data=[
                    'nip'=>$nip,
                    'nama'=>$nama,
                    'username'=>$nip,
                    'tanggal_buat'=> date("Y-m-d",time())
                ];
                $this->db->insert('Dosen',$data);
            }
        }
        return $this->db->affected_rows();
    }
    public function updateDosen($data,$nip){
        $this->db->update('Dosen', $data, ['nip' => $nip]);
        return $this->db->affected_rows();
    }
}
?>
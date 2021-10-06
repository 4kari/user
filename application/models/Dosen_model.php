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
        $this->db->insert('Dosen',$data);
        $nip = $data['nip'];
        $nama = $data['nama'];
        if($nip!="" && $nama!=""){
            // $user = json_decode($this->curl->simple_get('http://10.5.12.26/user/api/User/'),true);
            $user = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/User/',array('username' => $)),true);
            $cek=false;
            for ($i=0;$i<count($user);$i++){
                if($user['data'][$i]['username']==$nip){
                    $cek=true;
                }
            }
            if($cek==false){
                echo "user tidak ditemukan";
                $data=[
                    'username'=>$nip,
                    'password'=>$nip,
                    'level'=>"3"
                ];
                // json_decode($this->curl->simple_post('http://10.5.12.26/user/api/user/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
                json_decode($this->curl->simple_post('http://localhost/microservice/user/api/user/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
            }
            // $dosen = json_decode($this->curl->simple_get('http://10.5.12.26/user/api/Dosen/',array('nip'=>$nip),array(CURLOPT_BUFFERSIZE => 10)),true);
            $dosen = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/Dosen/',array('nip'=>$nip),array(CURLOPT_BUFFERSIZE => 10)),true);
            if ($dosen==NULL){
                $data=[
                    'nip'=>$nip,
                    'nama'=>$nama,
                    'username'=>$nip,
                    'tanggal_buat'=> date("Y-m-d",time())
                ];
                // json_decode($this->curl->simple_post('http://10.5.12.26/user/api/Dosen/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
                json_decode($this->curl->simple_post('http://localhost/microservice/user/api/Dosen/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
                echo "dosen ditambahkan";
            }else{
                echo "data sudah ada";
            }
        }else{
            echo "data kosong";
        }
        return $this->db->affected_rows();
    }
    public function updateDosen($data,$nip){
        $this->db->update('Dosen', $data, ['nip' => $nip]);
        return $this->db->affected_rows();
    }
}
?>
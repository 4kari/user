<?php
class Mahasiswa_model extends CI_Model{
    public function getMahasiswa($nim=null){
        if ($nim === null){
            return $this->db->get('Mahasiswa')->result_array();
        } else {
            return $this->db->get_where('Mahasiswa', ['nim' => $nim])->row_array();
        }
    }
    public function deleteMahasiswa($nim){
        $this->db->delete('Mahasiswa', ['nim' => $nim]);
        return $this->db->affected_rows();
    }
    public function createMahasiswa($data){
        $nim = $data['nim'];
        $nama = $data['nama'];
        // $user = json_decode($this->curl->simple_get('http://10.5.12.26/user/api/User/',array('username'=>$nim)),true);
        $user = json_decode($this->curl->simple_get('http://localhost/microservice/user/api/User/',array('username'=>$nim)),true);

        if(!$user){
            $data=[
                'username'=>$nim,
                'password'=>$nim,
                'level'=>"4"
            ];
            // json_decode($this->curl->simple_post('http://10.5.12.26/user/api/user/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
            json_decode($this->curl->simple_post('http://localhost/microservice/user/api/user/',$data,array(CURLOPT_BUFFERSIZE => 10)),true);
        }
        $mhs = $this->getMahasiswa($nim);

        if (!$mhs){
            $data=[
                'nim'=>$nim,
                'nama'=>$nama,
                'username'=>$nim,
                'prodi'=> substr($nim, 4, 3),
                'tanggal_buat'=> date("Y-m-d",time())
            ];
        $this->db->insert('Mahasiswa',$data);
        return $this->db->affected_rows();
        }
    }
    public function updateMahasiswa($data,$nim){
        $this->db->update('Mahasiswa', $data, ['nim' => $nim]);
        return $this->db->affected_rows();
    }
}
?>
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
        $this->db->delete('user', ['username' => $nip]);
        return $this->db->affected_rows();
    }
    public function createDosen($data){
        $nip = $data['nip'];
        $nama = $data['nama'];
        if($nip && $nama){
            $user = $this->db->get_where('user', ['username' => $nip])->row_array();
            if($user==false){
                $data=[
                    'username'=>$nip,
                    'password'=>$nip,
                    'level'=>"3"
                ];
                $this->db->insert('User',$data);
            }
            $dosen = $this->getDosen($nip);
            if ($dosen==NULL){
                $data=[
                    'nip'=>$nip,
                    'nama'=>$nama,
                    'username'=>$nip,
                    'tanggal_buat'=> date("Y-m-d",time()),
                    'beban'=>0
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
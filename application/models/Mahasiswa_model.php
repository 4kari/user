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
        $prodi=substr($nim, 4, 3);
        $Cprodi = $this->db->get_where('Prodi', ['kode_prodi' => $prodi])->row_array();

        if ($Cprodi){
            $user = $this->db->get_where('user', ['username' => $nim])->row_array();
            if(!$user){
                $data=[
                    'username'=>$nim,
                    'password'=>$nim,
                    'level'=>"4"
                ];
                $this->db->insert('User',$data);
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
        }else{
            return null;
        }
    }
    public function updateMahasiswa($data,$nim){
        $this->db->update('Mahasiswa', $data, ['nim' => $nim]);
        return $this->db->affected_rows();
    }
}
?>
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
        $this->db->insert('Mahasiswa',$data);
        return $this->db->affected_rows();
    }
    public function updateMahasiswa($data,$nim){
        $this->db->update('Mahasiswa', $data, ['nim' => $nim]);
        return $this->db->affected_rows();
    }
}
?>
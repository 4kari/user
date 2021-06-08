<?php
class Mahasiswa_model extends CI_Model{
    public function getMahasiswa($id=null){
        if ($id === null){
            return $this->db->get('Mahasiswa')->result_array();
        } else {
            return $this->db->get_where('Mahasiswa', ['id' => $id])->row_array();
        }
    }
    public function deleteMahasiswa($id){
        $this->db->delete('Mahasiswa', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createMahasiswa($data){
        $this->db->insert('Mahasiswa',$data);
        return $this->db->affected_rows();
    }
    public function updateMahasiswa($data,$id){
        $this->db->update('Mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
<?php
class Prodi_model extends CI_Model{
    public function getProdi($id=null){
        if ($id === null){
            return $this->db->get('Prodi')->result_array();
        } else {
            return $this->db->get_where('Prodi', ['id' => $id])->row_array();
        }
    }
    public function deleteProdi($id){
        $this->db->delete('Prodi', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createProdi($data){
        $this->db->insert('Prodi',$data);
        return $this->db->affected_rows();
    }
    public function updateProdi($data,$id){
        $this->db->update('Prodi', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
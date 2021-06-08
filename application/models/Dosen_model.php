<?php
class Dosen_model extends CI_Model{
    public function getDosen($id=null){
        if ($id === null){
            return $this->db->get('Dosen')->result_array();
        } else {
            return $this->db->get_where('Dosen', ['id' => $id])->row_array();
        }
    }
    public function deleteDosen($id){
        $this->db->delete('Dosen', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createDosen($data){
        $this->db->insert('Dosen',$data);
        return $this->db->affected_rows();
    }
    public function updateDosen($data,$id){
        $this->db->update('Dosen', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
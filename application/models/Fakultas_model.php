<?php
class Fakultas_model extends CI_Model{
    public function getFakultas($id=null){
        if ($id === null){
            return $this->db->get('Fakultas')->result_array();
        } else {
            return $this->db->get_where('Fakultas', ['id' => $id])->row_array();
        }
    }
    public function deleteFakultas($id){
        $this->db->delete('Fakultas', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createFakultas($data){
        $this->db->insert('Fakultas',$data);
        return $this->db->affected_rows();
    }
    public function updateFakultas($data,$id){
        $this->db->update('Fakultas', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
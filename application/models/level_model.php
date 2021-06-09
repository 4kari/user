<?php
class Level_model extends CI_Model{
    public function getLevel($id=null){
        if ($id === null){
            return $this->db->get('Level')->result_array();
        } else {
            return $this->db->get_where('Level', ['id' => $id])->row_array();
        }
    }
    public function deleteLevel($id){
        $this->db->delete('Level', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createLevel($data){
        $this->db->insert('Level',$data);
        return $this->db->affected_rows();
    }
    public function updateLevel($data,$id){
        $this->db->update('Level', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
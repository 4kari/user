<?php
class User_model extends CI_Model{
    public function getUser($id=null){
        if ($id === null){
            return $this->db->get('User')->result_array();
        } else {
            return $this->db->get_where('User', ['id' => $id])->row_array();
        }
    }
    public function deleteUser($id){
        $this->db->delete('User', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createUser($data){
        $this->db->insert('User',$data);
        return $this->db->affected_rows();
    }
    public function updateUser($data,$id){
        $this->db->update('User', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
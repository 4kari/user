<?php
class User_model extends CI_Model{
    public function getUser($username=null){
        if ($username === null){
            return $this->db->get('User')->result_array();
        } else {
            return $this->db->get_where('User', ['username' => $username])->row_array();
        }
    }
    public function deleteUser($username){
        $this->db->delete('User', ['username' => $username]);
        return $this->db->affected_rows();
    }
    public function createUser($data){
        $this->db->insert('User',$data);
        return $this->db->affected_rows();
    }
    public function updateUser($data,$username){
        $this->db->update('User', $data, ['username' => $username]);
        return $this->db->affected_rows();
    }
}
?>
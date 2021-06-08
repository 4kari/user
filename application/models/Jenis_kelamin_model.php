<?php
class Jenis_kelamin_model extends CI_Model{
    public function getJenis_kelamin($id=null){
        if ($id === null){
            return $this->db->get('Jenis_kelamin')->result_array();
        } else {
            return $this->db->get_where('Jenis_kelamin', ['id' => $id])->row_array();
        }
    }
    public function deleteJenis_kelamin($id){
        $this->db->delete('Jenis_kelamin', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createJenis_kelamin($data){
        $this->db->insert('Jenis_kelamin',$data);
        return $this->db->affected_rows();
    }
    public function updateJenis_kelamin($data,$id){
        $this->db->update('Jenis_kelamin', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
?>
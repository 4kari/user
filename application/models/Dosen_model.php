<?php
class Dosen_model extends CI_Model{
    public function getDosen($nip=null){
        if ($nip === null){
            return $this->db->get('Dosen')->result_array();
        } else {
            return $this->db->get_where('Dosen', ['nip' => $nip])->row_array();
        }
    }
    public function deleteDosen($nip){
        $this->db->delete('Dosen', ['nip' => $nip]);
        return $this->db->affected_rows();
    }
    public function createDosen($data){
        $this->db->insert('Dosen',$data);
        return $this->db->affected_rows();
    }
    public function updateDosen($data,$nip){
        $this->db->update('Dosen', $data, ['nip' => $nip]);
        return $this->db->affected_rows();
    }
}
?>
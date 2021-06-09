<?php
class Fakultas_model extends CI_Model{
    public function getFakultas($kode_fak=null){
        if ($kode_fak === null){
            return $this->db->get('Fakultas')->result_array();
        } else {
            return $this->db->get_where('Fakultas', ['kode_fak' => $kode_fak])->row_array();
        }
    }
    public function deleteFakultas($kode_fak){
        $this->db->delete('Fakultas', ['kode_fak' => $kode_fak]);
        return $this->db->affected_rows();
    }
    public function createFakultas($data){
        $this->db->insert('Fakultas',$data);
        return $this->db->affected_rows();
    }
    public function updateFakultas($data,$kode_fak){
        $this->db->update('Fakultas', $data, ['kode_fak' => $kode_fak]);
        return $this->db->affected_rows();
    }
}
?>
<?php
class Prodi_model extends CI_Model{
    public function getProdi($kode_prodi=null){
        if ($kode_prodi === null){
            return $this->db->get('Prodi')->result_array();
        } else {
            return $this->db->get_where('Prodi', ['kode_prodi' => $kode_prodi])->row_array();
        }
    }
    public function deleteProdi($kode_prodi){
        $this->db->delete('Prodi', ['kode_prodi' => $kode_prodi]);
        return $this->db->affected_rows();
    }
    public function createProdi($data){
        $this->db->insert('Prodi',$data);
        return $this->db->affected_rows();
    }
    public function updateProdi($data,$kode_prodi){
        $this->db->update('Prodi', $data, ['kode_prodi' => $kode_prodi]);
        return $this->db->affected_rows();
    }
}
?>
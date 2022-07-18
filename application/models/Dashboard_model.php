<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getcarddashboard()
    {
        $this->db->get_where('tbl_kode_barang', ['kode_barang'])->result_array();
    }

    public function getuserrole()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $query = $this->db->get()->result_array();
        return $query;
    }
}

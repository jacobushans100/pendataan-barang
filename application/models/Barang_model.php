<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function getktbarang()
    {
        $query = "SELECT `tbl_databarang`.*,`tbl_kategori_barang`.`kategori_barang`
        FROM `tbl_databarang` JOIN `tbl_kategori_barang`
        ON `tbl_databarang`.`ktbarang`=`tbl_kategori_barang`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    // public function getktBarangCt()
    // {
    //     $query = "SELECT `tbl_transaksi`.*,`tbl_kategori_barang`.`kategori_barang`
    //     FROM `tbl_transaksi` JOIN `tbl_kategori_barang`
    //     ON `tbl_transaksi`.`kategori`=`tbl_kategori_barang`.`id`
    //     ";
    //     return $this->db->query($query)->result_array();
    // }
    public function getdatabeli()
    {
        //join 3 table
        $this->db->select('*');
        $this->db->from('tbl_sementara');
        $this->db->join('tbl_databarang', 'tbl_sementara.id_produk = tbl_databarang.id');
        $this->db->join('tbl_kategori_barang', 'tbl_sementara.kategori_produk = tbl_kategori_barang.id');
        $query = $this->db->get()->result_array();
        return $query;
        // $query = "SELECT `order`.*,`tbl_databarang`.`nama_barang`
        // FROM `order` JOIN `tbl_databarang`
        // ON `order`.`id_produk`=`tbl_databarang`.`id`
        // ";
        // return $this->db->query($query)->result_array();
    }

    public function getsimpan()
    {
        $query = "SELECT `tbl_sementara`.*,`tbl_kategori_barang`.`kategori_barang`
        FROM `tbl_sementara` JOIN `tbl_kategori_barang`
        ON `tbl_sementara`.`kategori_produk`=`tbl_kategori_barang`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getnamabrg()
    {
        //join 3 table
        $this->db->select('*');
        $this->db->from('barang_keluar');
        $this->db->join('tbl_databarang', 'barang_keluar.id_barang = tbl_databarang.id');
        $this->db->join('tbl_kategori_barang', 'barang_keluar.kategori = tbl_kategori_barang.id');
        $query = $this->db->get()->result_array();
        return $query;

        // $query = "SELECT `barang_keluar`.*,`tbl_databarang`.`nama_barang`
        // FROM `barang_keluar` JOIN `tbl_databarang`
        // ON `barang_keluar`.`id_barang`=`tbl_databarang`.`id`
        // ";
        // return $this->db->query($query)->result_array();
    }

    public function gethpsbkeluar()
    {
        $this->db->select('*');
        $this->db->from('barang_keluar');
        $this->db->join('tbl_databarang', 'barang_keluar.id_barang = tbl_databarang.id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getJumlahKategoriBarang()
    {
        $this->db->select('tbl_kategori_barang.id', 'kategori_barang');
        $this->db->select('kategori_barang');
        $this->db->select_sum('jumlah');
        $this->db->from('tbl_databarang');
        $this->db->join('tbl_kategori_barang', 'tbl_kategori_barang.id = tbl_databarang.ktbarang');
        $this->db->group_by('ktbarang');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getJumlahbarang()
    {
        $this->db->select_sum('jumlah');
        $query = $this->db->get('tbl_databarang')->result_array();
        return $query;
    }

    public function getJumlahbarangkeluar()
    {
        $this->db->select_sum('jumlah_barang');
        $query = $this->db->get('barang_keluar')->result_array();
        return $query;
    }

    public function getJumlahbrgbeli()
    {
        $this->db->select_sum('total_hbeli');
        $query = $this->db->get('tbl_databarang')->result_array();
        return $query;
    }

    public function getJumlahbrgjual()
    {
        $this->db->select_sum('harga_total');
        $query = $this->db->get('barang_keluar')->result_array();
        return $query;
    }

    public function jmlm()
    {
        $this->db->select('tbl_kategori_barang.id', 'kategori_barang');
        $this->db->select('kategori_barang');
        $this->db->select_sum('jumlah');
        $query = $this->db->get()->result_array();
        return $query;
    }

    // public function gettbldatabrg($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->get('tbl_databarang')->result_array();
    // }

    public function tambah($table, $field)
    {
        return $this->db->insert($table, $field);
    }

    public function tampil_order($field, $table, $order)

    {
        $this->db->order_by($field, $order);
        return $this->db->get($table);
    }

    public function hapuskategori($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_kategori_barang');
        $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Kategori barang berhasil dihapus!"></div>');
        redirect('admin/kategoribarang');
    }
    public function hapusbarang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_databarang');
        $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Barang berhasil dihapus!"></div>');
        redirect('barang/databarang');
    }
    // public function ubahbarang()
    // {

    // }
    // public function tmbhstok()
    // {

    // }
    public function belibarang($id)
    {
        $this->db->where('id', $id);
        $this->db->get('tbl_databarang')->result_array();
    }

    public function getBarangById($id)
    {
        return $this->db->get_where('tbl_databarang', ['id' => $id])->result_array();
    }

    public function insertTransaksi($data)
    {
        $this->db->insert('barang_keluar', $data);
    }

    public function kurangiStock($jumlah, $id)
    {
        $this->db->set('jumlah', $jumlah);
        $this->db->where('id', $id);
        return $this->db->update('tbl_databarang');
    }

    public function hapusriwayattransaksi()
    {
        return $this->db->empty_table('barang_keluar');
    }

    public function hapusdatatransaksi()
    {
        return $this->db->empty_table('tbl_sementara');
    }

    public function get_limit_data($daterange)
    {

        $this->db->where('tanggal >=', $daterange[0]);
        $this->db->where('tanggal <=', $daterange[1]);
        $this->db->select('barang_keluar');
        $this->db->order_by('tanggal', 'ASC');
        $isi = $this->db->get()->result();
        var_dump($isi);
        die;
        // $this->db->select('*'); 
        // $this->db->where('tanggal',$start); 
        // $this->db->where('tanggal',$end); 
        // $this->db->order_by('tanggal', 'ASC');

        // $isi = $this->db->get('tbl_transaksi');
        // var_dump($isi);
        // die;
    }
}

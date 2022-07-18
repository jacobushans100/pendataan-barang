<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('barang_model');
    }
    public function index()
    {
        $data['title'] = 'Tambah barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['alert_stok'] = $this->db->get('tbl_databarang')->result_array();
        $data['ktbarang'] = $this->db->get('tbl_kategori_barang')->result_array();
        $this->form_validation->set_rules(
            'ktg_barang',
            'ktg_barang',
            'required',
            ['required' => 'Kategori barang tidak boleh kosong!']
        );
        // $this->form_validation->set_rules(
            //     'id',
            //     'id',
            //     'required|is_unique|min_length[8]',
            //     [
                //         'required' => 'Kategori tidak boleh kosong!',
        //         'is_unique' => 'Kode barang sudah terdaftar',
        //         'min_length' => 'Kode barang harus 8 karakter'
        //     ]
        // );
        // $this->form_validation->set_rules(
            //     'tgl',
            //     'tgl',
            //     'required',
            //     ['required' => 'Tanggal tidak boleh kosong!']
            // );
            $this->form_validation->set_rules(
                'namabrg',
                'namabrg',
                'required',
                ['required' => 'Jumlah barang tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'hjual',
            'hjual',
            'required',
            ['required' => 'Harga barang tidak boleh kosong!']
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/index', $data);
            $this->load->view('templates/footer');
        } else {
            $hbeli = str_replace(',', '', $this->input->post('hbeli'));
            $stok = $this->input->post('stok');
            $ttlhargabeli = $hbeli * $stok;
            $data = [
                // 'id' => $this->input->post('id'),
                'ktbarang' => $this->input->post('ktg_barang'),
                'nama_barang' => $this->input->post('namabrg'),
                'jumlah' => $this->input->post('stok'),
                'hargabeli' => str_replace(',', '', $this->input->post('hbeli')),
                'hargajual' => str_replace(',', '', $this->input->post('hjual')),
                'total_hbeli' => $ttlhargabeli,
                'tanggal_ditambahkan' => date('Y-m-d H:i:s')
            ];
            if (preg_match('#[0-9]#', $data['nama_barang'])) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Angka tidak diizinkan!"></div>');
                redirect('barang');
            } else {
                $this->db->insert('tbl_databarang', $data);
                $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data barang berhasil ditambahkan!"></div>');
                redirect('barang');
            }
        }
    }
    
    public function databarang()
    {
        $data['title'] = 'Data barang';
        $this->load->model('barang_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['alert_stok'] = $this->db->get('tbl_databarang')->result_array();
        $data['databarang'] = $this->barang_model->getktbarang();
        $data['ktbarang'] = $this->db->get('tbl_kategori_barang')->result_array();
        $data['barang'] = $this->db->get('tbl_databarang')->result_array();
        $this->form_validation->set_rules(
            'nmbarang',
            'nmbarang',
            'required',
            ['required' => 'Nama barang tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'kd_barang',
            'Kd_barang',
            'required',
            ['required' => 'Kategori tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'jmlbarang',
            'Jmlbarang',
            'required',
            ['required' => 'Jumlah barang tidak boleh kosong!']
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/databarang', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'ktbarang' => $this->input->post('kd_barang'),
                'nama_barang' => $this->input->post('nmbarang'),
                'jumlah' => $this->input->post('jmlbarang'),
                'harga' => $this->input->post('hjual')
            ];
            if (preg_match('#[0-9]#', $data['nama_barang'])) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Angka tidak diizinkan!"></div>');
                redirect('barang/databarang');
            } else {
                if ($data['jumlah'] > 100) {
                    $this->session->set_flashdata('message', '<div class="error" data-flashdata="Data stok barang tidak boleh lebih dari 100!"></div>');
                    redirect('barang/databarang');
                } else {
                    $this->db->insert('tbl_databarang', $data);
                    $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data barang berhasil ditambahkan!"></div>');
                    redirect('barang/databarang');
                }
            }
        }
    }
    
    // public function detailbrg($id)
    // {
    //     $data['title'] = 'Detail barang';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['detailbarang'] = $this->barang_model->gettbldatabrg($id);
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('barang/detaildtbrg', $data);
    //     $this->load->view('templates/footer');   
    // }

    public function tambahstok()
    {
        $id = $this->input->post('id');
        $data = [
            'jml' => $this->input->post('jmlstok')
        ];
        $query = $this->db->get_where('tbl_databarang', ['id' => $id]);
        $tambahstok = $query->result_array();
        foreach ($tambahstok as $ts) {
            $qtyttl = $ts['jumlah'] + $data['jml'];
            $hrgjml = $ts['hargabeli'] * $qtyttl;
            if ($qtyttl > 100) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Data stok barang tidak boleh lebih dari 100!"></div>');
                redirect('barang/databarang');
            } else {
                $this->db->set('jumlah', $qtyttl);
                $this->db->set('total_hbeli', $hrgjml);
                $this->db->where('id', $id);
                $this->db->update('tbl_databarang');
                $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Tambah Data stok barang berhasil ditambahkan!"></div>');
                redirect('barang/databarang');
            }
        }
    }

    public function hapusbarang($id)
    {
        $this->barang_model->hapusbarang($id);
    }
    
    public function ubahbarang()
    {
        
        $data['kodebarang'] = $this->barang_model->getktbarang();
        $id =  $this->input->post('id');
        $kd_barang = $this->input->post('kd_barang');
        $nama_barang = $this->input->post('nama_barang');
        $hjual = str_replace(',', '', $this->input->post('hjual'));
        $jumlah = $this->input->post('jml');
        $hbeli = str_replace(',', '', $this->input->post('hbeli'));
        $ttl_hbeli = $jumlah * $hbeli;

        if (preg_match('#[0-9]#', $nama_barang)) {
            $this->session->set_flashdata('message', '<div class="error" data-flashdata="Angka tidak diizinkan!"></div>');
            redirect('barang/databarang');
            // Ini bagusnya taro di controller bjir buat logika flasdata dsb
        } else {
            $this->db->set('ktbarang', $kd_barang);
            $this->db->set('nama_barang', $nama_barang);
            $this->db->set('hargabeli', $hbeli);
            $this->db->set('hargajual', $hjual);
            $this->db->set('total_hbeli', $ttl_hbeli);
            $this->db->where('id', $id);
            $this->db->update('tbl_databarang');
            $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data barang berhasil diubah!"></div>');
            redirect('barang/databarang');

            // ga tau, php kan emg ga jelas
            // ini kalo pake backtik bisa masukin " sama ' di dalem
            // kalo pake ' ga bisa masukin ", tp kalo pake " bisa masukin '
            // ya gitulah
            // itu tinggal kasih class error atau sukses sama data-flashdata di flashdatanya
            //yak yaudah gua dc dah
        }
    }
}
    
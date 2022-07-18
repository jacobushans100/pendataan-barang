<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // dah
        // coba pas login ada bug gak njir
        $this->load->model('barang_model');
    }
    public function index()
    {
        $data['title'] = 'Akun profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function barangkeluar()
    {
        $data['title'] = 'Barang keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hpsbkeluar'] = $this->barang_model->gethpsbkeluar();
        $data['brgkeluar'] = $this->barang_model->getnamabrg();
        $data['alert_stok'] = $this->db->get('tbl_databarang')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/barangkeluar', $data);
        $this->load->view('templates/footer');
    }

    public function hapusbarang($id_barangkeluar)
    {
        $this->db->where('id_barangkeluar', $id_barangkeluar);
        $this->db->delete('barang_keluar');
        $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data barang keluar berhasil dihapus!"></div>');
        redirect('user/barangkeluar');
    }
    // public function transaksi()
    // {
    //     $data['title'] = 'Tambah transaksi penjualan';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['barang'] = $this->barang_model->getktbarang();
    //     $data['ktgbarang'] = $this->db->get('tbl_kategori_barang')->result_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('user/transaksi', $data);
    //     $this->load->view('templates/footer');
    // }
    public function beli($id)
    {
        $data['title'] = 'Tambah transaksi penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->get('tbl_databarang')->result_array();
        $data['kirimdatabarang'] = $this->barang_model->belibarang($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function catatTransaksi()
    {

        $this->form_validation->set_rules(
            'namaBarang',
            'namaBarang',
            'required',
            ['required' => 'Nama barang tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'kategoriBarang',
            'kategoriBarang',
            'required',
            ['required' => 'Kategori barang tidak boleh kosong!']
        );
        if ($this->form_validation->run() == false) {
            // redirect('user/transaksi');
            var_dump(validation_errors());
        } else {
            $id = $this->input->post('id');
            $data = [
                'nama' => $this->input->post('namaBarang'),
                'kategori' => $this->input->post('kategoriBarang'),
                'harga' => $this->input->post('hargaJual'),
                'tanggal' => date('Y-m-d H:i:s'),
                'jumlah' => $this->input->post('qty'),
                'harga_total' => $this->input->post('totalHarga')
            ];

            $query = $this->db->get_where('tbl_databarang', ['id' => $id]);
            $dataBarang = $query->result_array();

            foreach ($dataBarang as $db) {
                $ttlstok = $db['jumlah'] - $data['jumlah'];
                if ($ttlstok <= 0) {
                    $this->session->set_flashdata('message', '<div class="error" data-flashdata="Stok habis!"></div>');
                    redirect('user/transaksi');
                } else {
                    $this->db->set('jumlah', $ttlstok);
                    $this->db->where('id', $id);
                    $this->db->update('tbl_databarang');
                }
            }
            $this->db->insert('tbl_transaksi', $data);
            $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data transaksi penjualan berhasil ditambahkan!"></div>');
            redirect('user/laporan');
        }
    }

    public function inputbarangkeluar()
    {
        $data['title'] = 'Input barang keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->barang_model->getktbarang();
        $data['alert_stok'] = $this->db->get('tbl_databarang')->result_array();
        $data['keranjang'] = $this->barang_model->getdatabeli();
        $data['simpan'] = $this->barang_model->getsimpan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/inputbarangkeluar', $data);
        $this->load->view('templates/footer');
        // $id_penjualan =  $this->barang_model->tampil_order('id','tbl_databarang','DESC');
        // if(empty($id_penjualan)){
        //     $data['kode_jual'] = 1;
        // }else{
        //     $data['kode_jual'] = $id_penjualan+1;
        // }
    }

    public function cetakbarangkeluar()
    {
        $data['title'] = 'Cetak barang keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->barang_model->getnamabrg();
        $data['alert_stok'] = $this->db->get('tbl_databarang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/cetakbarangkeluar', $data);
        $this->load->view('templates/footer');
        // $id_penjualan =  $this->barang_model->tampil_order('id','tbl_databarang','DESC');
        // if(empty($id_penjualan)){
        //     $data['kode_jual'] = 1;
        // }else{
        //     $data['kode_jual'] = $id_penjualan+1;
        // }
    }

    public function resetkeranjang()
    {
        $this->barang_model->hapusdatatransaksi();
        redirect('user/inputbarangkeluar');
    }

    public function resetriwayat()
    {
        $this->barang_model->hapusriwayattransaksi();
        redirect('user/barangkeluar');
    }

    public function simpanBarangBaru()
    {
        $dataBarang = $this->barang_model->getdatabeli();
        foreach ($dataBarang as $db) {
            $id = $db['id_produk'];
            // $nmp = $db['nama_produk'];
            $ktprdk = $db['kategori_produk'];
            $hrg = $db['harga'];
            $jml = $db['jumlahbarang'];
            $ttl = $db['total'];
            $data = [
                'id_barang' => $id,
                // 'nama' => $nmp,
                'kategori' => $ktprdk,
                'harga' => $hrg,
                'tanggal' => date('Y-m-d H:i:s'),
                'jumlah_barang' => $jml,
                'harga_total' => $ttl,
            ];
            $barang = $this->barang_model->getBarangById($id);

            $jumlahBarang = $barang[0]['jumlah'];
            $jumlahDiBeli = $db['jumlahbarang'];
            // $data = [
            //     'id_produk' => $this->input->post('idproduk'),
            //     'nama' => $this->input->post('nmbarang'),
            //     'kategori' => $this->input->post('ktbarang'),
            //     'harga' => $this->input->post('harga'),
            //     'tanggal' => date('Y-m-d H:i:s'),
            //     'jumlah' => $this->input->post('jml'),
            //     'harga_total' => $this->input->post('ttl_harga')
            // ];

            if ($jumlahDiBeli <= 0) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Masukkan jumlah barang!"></div>');
                redirect('user/inputbarangkeluar');
            }
            if ($jumlahBarang < $jumlahDiBeli) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Stok kurang!"></div>');
                redirect('user/inputbarangkeluar');
            } else {
                // Kurangi stock
                $jumlah = $jumlahBarang - $jumlahDiBeli;
                $this->barang_model->kurangiStock($jumlah, $id);
                // Insert ke tabel transaksi
                $this->barang_model->insertTransaksi($data);

                $this->barang_model->hapusdatatransaksi();
            }
        }
        $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data transaksi penjualan berhasil ditambahkan!"></div>');
        redirect('user/inputbarangkeluar');
    }

    public function beliproduk($id, $harga, $ktbarang)
    {
        // $data = $this->barang_model->getktbarang();
        // $id_penjualan =  $this->barang_model->tampil_order('id','tbl_databarang','DESC');
        // if(empty($id_penjualan)){
        //     $kode_jual = 1;
        // }else{
        //     $kode_jual = $id_penjualan+1;
        // }

        $field['id_produk'] = $id;
        // $field['nama_produk'] = $nama_barang;
        $field['kategori_produk'] = $ktbarang;
        $field['harga'] = $harga;
        $field['jumlahbarang'] = 0;
        $field['total'] = 0;
        $this->barang_model->tambah('tbl_sementara', $field);
        redirect('user/inputbarangkeluar');
    }

    public function updatebeli()
    {
        // $id =  $this->input->post('id');
        $id = $this->input->post('id');
        $hrg = $this->input->post('harga');
        $jml = $this->input->post('jml');
        $total = $jml * $hrg;
        $this->db->set('jumlahbarang', $jml);
        $this->db->set('total', $total);
        $this->db->where('id_simpan', $id);
        $this->db->update('tbl_sementara');
        redirect('user/inputbarangkeluar');
    }

    public function hapusbeli($id_simpan)
    {
        $this->db->where('id_simpan', $id_simpan);
        $this->db->delete('tbl_sementara');
        // $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data transaksi berhasil dihapus!"></div>');
        redirect('user/inputbarangkeluar');
    }


    public function edit()
    {
        $data['title'] = 'Akun profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = htmlspecialchars($this->input->post('name'));
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_img = $_FILES['image']['name'];

            if ($upload_img) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '1024';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default1.gif') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Profil berhasil diubah!"></div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Akun profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules(
            'current_password',
            'Current Password',
            'required|trim',
            ['required' => 'Password tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'new_password1',
            'New Password',
            'required|trim|min_length[3]|matches[new_password2]',
            [
                'required' => 'Pasword tidak boleh kosong!',
                'min_length' => 'Password terlalu pendek!',
                'matches' => 'Password baru harus sama dengan konfirmasi password baru!'
            ]
        );
        $this->form_validation->set_rules(
            'new_password2',
            'Confirm New Password',
            'required|trim|min_length[3]|matches[new_password1]',
            [
                'required' =>  'Konfirmasi password tidak boleh kosong!',
                'min_length' => 'Password terlalu pendek!',
                'matches' => 'Konfirmasi password baru harus sama dengan password baru!'
            ]
        );
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Password lama salah!"></div>');
                redirect('user/index');
            } else {
                if ($current_password == $new_password) {

                    $this->session->set_flashdata('message', '<div class="error" data-flashdata="Password baru jangan sama dengan password lama!"></div>');
                    redirect('user/index');
                } else {
                    //password sudah benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Password berhasil diubah!"></div>');
                    redirect('user/index');
                }
            }
        }
    }

    public function tambahbarang()
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

    public function hapusdatabarang($id)
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

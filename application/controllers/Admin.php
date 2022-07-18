<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_admin(); ///oke ty rafff
        $this->load->model('barang_model');
        $this->load->model('dashboard_model');
    }
    public function index()
    {
        $data['alert_stok'] = $this->db->get('tbl_databarang')->result_array();
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['card'] = $this->barang_model->getJumlahKategoriBarang();
        $data['datauser'] = $this->db->get('user')->result_array();
        $data['jmlbarang'] = $this->barang_model->getJumlahbarang();
        $data['jmlbrgkeluar'] = $this->barang_model->getJumlahbarangkeluar();
        $data['jmlbrgb'] = $this->barang_model->getJumlahbrgbeli();
        $data['tbrg'] = $this->barang_model->getJumlahbrgjual();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
        // $this->db->select_sum('jumlah');
        // $this->db->select(['ktbarang']);
        // $data['makanan'] = $this->barang_model->getktbarang();
        // $data['makanan'] = $this->barang_model->getJumlahKategoriBarang();
        // $this->db->select_sum('jumlah');
        // $this->db->select(['ktbarang']);
        // $data['makanan'] = $this->db->get_where('tbl_databarang', ['ktbarang' => 'Makanan'])->result_array();
        // $this->db->select_sum('jumlah');
        // $this->db->select(['ktbarang']);
        // $data['minuman'] = $this->db->get_where('tbl_databarang', ['ktbarang' => 'Minuman'])->result_array();
        // $this->db->select_sum('jumlah');
        // $this->db->select(['ktbarang']);
        // $data['snack'] = $this->db->get_where('tbl_databarang', ['ktbarang' => 'Snack'])->result_array();
        // $this->db->select_sum('harga_total');
        // $this->db->select(['kategori']);
        // $data['ttlsnack'] = $this->db->get_where('barang_keluar', ['kategori' => 'Snack'])->result_array();
        // ^ buat kek di atas satu2 hadehhhh
    }


    public function edituser()
    {
        $id = $this->input->post('id');
        $rlid = $this->input->post('roleid');
        $actv = $this->input->post('isactive');
        $this->db->set('role_id', $rlid);
        $this->db->set('is_active', $actv);
        $this->db->where('id', $id);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Berhasil di ubah!"></div>');
        redirect('admin/aturuser');
    }

    public function hapususer($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data user berhasil dihapus!"></div>');
        redirect('admin/aturuser');
    }


    public function kategoribarang()
    {
        $data['title'] = 'Kategori barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kdbarang'] = $this->db->get('tbl_kategori_barang')->result_array();
        $this->form_validation->set_rules(
            'kategoribarang',
            'kategoribarang',
            'required|is_unique[tbl_kategori_barang.kategori_barang]',
            [
                'is_unique' => 'Kategori ini sudah terdaftar!',
            ]
        );
        // $this->form_validation->set_rules(
        //     'icon',
        //     'icon',
        //     'required',
        //     [
        //         'required' => 'Icon harus diisi!!',
        //     ]
        // );
        // $this->form_validation->set_rules(
        //     'deskripsi',
        //     'deskripsi',
        //     'required',
        //     [
        //         'required' => 'Deskripsi harus diisi!!',
        //     ]
        // );

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kategoribarang', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kategori_barang' => $this->input->post('kategoribarang')
            ];
            if (!preg_match("/^[a-zA-Z]*$/", $data['kode_barang'])) {
                $this->session->set_flashdata('message', '<div class="error" data-flashdata="Angka tidak diizinkan!"></div>');
                redirect('admin/kategoribarang');
            } else {
                $this->db->insert('tbl_kategori_barang', $data);
                $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Kode barang berhasil ditambahkan!"></div>');
                redirect('admin/kategoribarang');
            }
        }
    }
    public function hapuskategori($id)
    {
        $this->barang_model->hapuskategori($id);
    }
    public function ubahkategori()
    {
        $id =  $this->input->post('id');
        // $deskripsi = $this->input->post('deskripsi');
        $data = [
            'kategori_barang' => $this->input->post('kategoribarang'),
            /*'icon' => $this->input->post('icon')*/
        ];
        $ktbrg = $data['kategori_barang'];
        // $icon = $data['icon'];
        // print_r($data);
        // var_dump(preg_match('#[0-9]#', $kdbrg));
        // die();
        if (preg_match('#[0-9]#', $ktbrg)) {


            $this->session->set_flashdata('message', '<div class="error" data-flashdata="Angka tidak diizinkan!"></div>');
            // $this->session->set_flashdata('message', preg_match("/^[a-zA-Z]*$/", $kdbrg && $icon));
            redirect('admin/kategoribarang');
        } else {
            $this->db->set('kategori_barang', $ktbrg);
            //$this->db->set('icon', $icon);
            // $this->db->set('deskripsi', $deskripsi);
            $this->db->where('id', $id);
            $this->db->update('tbl_kategori_barang');
            $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Kategori barang berhasil diubah!"></div>');
            redirect('admin/kategoribarang');
        }
    }

    public function aturuser()
    {
        $data['title'] = 'Atur pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['datauser'] = $this->db->get('user')->result_array();
        $this->form_validation->set_rules(
            'name',
            'Name',
            'required|trim',
            ['required' => 'Nama tidak boleh kosong!']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'required' => 'Email tidak boleh kosong!',
                'is_unique' => 'Email ini sudah terdaftar!',
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required' => 'Password tidak boleh kosong!',
                'matches' => 'Password tidak sama!',
                'min_length' => 'Password terlalu pendek!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/aturuser', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),
                'role_id' => $this->input->post('role'),
                'is_active' => 1,
                'date_created' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="sukses" data-flashdata="Data berhasil ditambahkan!"></div>');
            redirect('admin/aturuser');
        }
    }

    // public function role()
    // {
    //     $data['title'] = 'Role';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['role'] = $this->db->get('user_role')->result_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/role', $data);
    //     $this->load->view('templates/footer');
    // }
    public function roleAccess($role_id)
    {
        $data['title'] = 'Akses Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }
    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses telah diubah!</div>');
    }
}

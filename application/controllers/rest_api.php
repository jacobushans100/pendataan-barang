<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class rest_api extends REST_Controller {

    // Dah tinggal bikin controller baru kek gini
    // ini kan datanya statis
    // nah lu datanya dari db
    // hapus aja, ini cuma statis

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
       $this->load->database();
    }

    function index_get()
    {
        // ga ada stok
        // kasih stok dulu
        
        $id = $this->get('id');
        if($id == ''){
            $rest_api = $this->db->get('tbl_databarang')->result();
        }else{
            $this->db->where('id', $id);
            $rest_api = $this->db->get('tbl_databarang')->result();
        }
        $this->response($rest_api, 200);
    }

    // bikin lagi method post
    function index_post()
    {
        $data = array(
            'id' => $this->post('id'),
            'ktbarang' => $this->post('ktbarang'),
            'nama_barang' => $this->post('nmbarang'),
            'jumlah' => $this->post('jml'),
            'harga' => $this->post('harga'),
        );
        $insert = $this->db->insert('tbl_databarang', $data);
        if($insert){
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

}

<?php 

class Admin_model extends CI_Model {


    function showproduk()
    {
        $this->db->join('kategori','kategori.id = produk.kategori_id');
        return $this->db->get('produk')->result();
    }
}
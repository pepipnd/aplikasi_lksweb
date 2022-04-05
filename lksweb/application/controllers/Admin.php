<?php 

class Admin extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Admin_model','am');

        if($_SESSION['level'] == '' or $_SESSION['level'] != 'admin') 
        {
            redirect('/');
        }  
    }

    function index()
    {
        $this->load->view('template/header');
        $this->load->view('admin/index');
        $this->load->view('template/footer');
    }

    
    function produk()
    {
        $data['produk'] = $this->am->showproduk();
        $this->load->view('template/header');
        $this->load->view('admin/produk', $data);
        $this->load->view('template/footer');
    }

    function kategori()
    {
        $this->load->view('template/header');
        $this->load->view('admin/kategori');
        $this->load->view('template/footer');
    }

    function transaksi()
    {
        $this->load->view('template/header');
        $this->load->view('admin/transaksi');
        $this->load->view('template/footer');
    }

    function add_produk()
    {
        $this->load->view('template/header');
        $this->load->view('admin/add_produk');
        $this->load->view('template/footer');
    }
}
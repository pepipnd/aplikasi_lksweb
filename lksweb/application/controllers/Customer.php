<?php 

class Customer extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Customer_model','cm');


        if($_SESSION['level'] == '' or $_SESSION['level'] != 'customer') 
        {
            redirect('/');
        }  
    }

    function index()
    {
        //menampilkan data produk 
        $data['produk'] = $this->cm->show_produk();

        //keranjang belanja
        $total =  $this->cm->showchart();
        $data['total'] = $total[0]->total;

        $this->load->view('template_user/header', $data);
        $this->load->view('customer/index', $data);
        $this->load->view('template_user/footer');
    }

    function transaksi()
    {
        $data['datatransaksi']  = $this->cm->showtransaksi();
        
        $total =  $this->cm->showchart();
        $data['total'] = $total[0]->total;

        $this->load->view('template_user/header', $data);
        $this->load->view('customer/datatransaksi', $data);
        $this->load->view('template_user/footer');
    }

    function add_chart($id)
    {
        $this->cm->tambah_data($id);
        redirect('Customer');
    }

    function lihat_keranjang(){

        $total =  $this->cm->showchart();
        $data['total'] = $total[0]->total;
        $data['keranjang'] = $this->cm->showkeranjang();
        
        $this->load->view('template_user/header', $data);
        $this->load->view('customer/keranjangbelanja', $data);
        $this->load->view('template_user/footer');
    }

    function delete_keranjang($id)
    {
        $this->cm->delete_keranjang($id);
        redirect('Customer/lihat_keranjang');
    }

    function search()
    {
        $data['produk'] = $this->cm->show_produk();
        
        //keranjang belanja
        $total =  $this->cm->showchart();
        $data['total'] = $total[0]->total;

        $this->load->view('template_user/header', $data);
        $this->load->view('customer/index', $data);
        $this->load->view('template_user/footer');
    }

    function checkout()
    {
        $idnya = $this->cm->checkout();

        redirect('Customer/show_detail/'.$idnya);
    }

    function show_detail($id)
    {
        //invoice
        $invdetail = $this->cm->showdetail($id);
        $data['invoice'] = $invdetail[0];

        //detail invoice
        $data['invoice_detail'] = $this->cm->showdetailproduk($id);

        //keranjang belanja
        $total =  $this->cm->showchart();
        $data['total'] = $total[0]->total;

        $this->load->view('template_user/header', $data);
        $this->load->view('customer/invoice', $data);
        $this->load->view('template_user/footer');
    }

    
}
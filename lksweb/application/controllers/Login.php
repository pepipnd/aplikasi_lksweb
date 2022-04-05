<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Login_model','login');

	}
	
	public function index()
	{
		$this->load->view('login');
	}

	public function daftar()
	{
		$this->load->view('daftar');
	}

	function daftar_aksi()
	{
		if($this->login->tambah_data()){
			
			redirect('/');
		}else{
			redirect(base_url('login/daftar'));
		}
	}

	function proses_login()
	{
		$hasilcek = $this->login->cekuser(); 
		if($hasilcek){
			//data diri
			$sess_data['id'] = $hasilcek[0]->id;
			$sess_data['level'] = $hasilcek[0]->level;
			$sess_data['nama'] = $hasilcek[0]->nama_lengkap;

			$this->session->set_userdata($sess_data);

			if($sess_data['level'] == 'admin'){
				redirect (base_url('admin'));
			}else{
				redirect (base_url('customer'));
			}

		}else{
			redirect('/');
		}
	}

	function dashboardadmin()
	{
		echo "ini admin";
	}
	function dashboardcustomer()
	{
		echo "ini customer";
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}



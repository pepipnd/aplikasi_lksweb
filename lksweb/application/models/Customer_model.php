<?php 

class Customer_model extends CI_Model{

    function show_produk()
    {
        @$search = $this->input->post('search'); 

        if(@$search){
            $this->db->select('*');
            $this->db->from('produk');
            $this->db->like('nama_produk', $search); 
            return $this->db->get()->result();
        }else
        {
            return $this->db->get('produk')->result();
        }
    }
    function showtransaksi()
    {
        $userlogin = $_SESSION['id'];
        
        return  $this->db->get_where('transaksi', array('customer_id' => $userlogin))->result();
    }

    function tambah_data($id)
    {
        $produk = $id;
        $user = $_SESSION['id'];

        //mengurangi stok
        $barang =  $this->db->get_where('produk', array('id' => $produk))->result();
        $stok       = $barang[0]->stok;
        $stokbarang = $barang[0]->stok-1;

        //proses update stok barang
        if($stok){
            
            //cek data
            $cari =  $this->db->get_where('tmp_trs', array('barang_id' => $produk, 'user_id' => $user))->result();
            $tmpid = $cari[0]->id;
            $qty_asal = $cari[0]->qty+1;
            //deklarasi 
            if($cari){
                $data = array(
                    'qty' => $qty_asal
                );

                $where = array(
                    'id' => $tmpid,
                );
                $this->db->update('tmp_trs', $data, $where);

            }else
            {
                $data = array(
                    'user_id' => $user,
                    'barang_id' => $produk,
                    'qty' => 1
                );
                $this->db->insert('tmp_trs', $data);
            }


            //update stok data barang
            $data = array(
                'stok' => $stokbarang
            );
    
            $where = array(
                'id' => $produk,
            );
            $this->db->update('produk', $data, $where);
        }
        

    }

    function showchart()
    {
        $user = $_SESSION['id'];
        
        $this->db->select('sum(qty) as total');
        $this->db->from('tmp_trs');
        $this->db->where('user_id', $user);
        return $this->db->get()->result();
    }

    function showkeranjang()
    {
        $user = $_SESSION['id'];
        
        $this->db->select('*, tmp_trs.id as idtmp');
        $this->db->from('tmp_trs');
        $this->db->join('produk', 'produk.id = tmp_trs.barang_id ');
        $this->db->where('user_id', $user);
        return $this->db->get()->result();
    }

    function delete_keranjang($id)
    {
        
        //cek barang
        $brg        = $this->db->get_where('tmp_trs', array('id' => $id))->result();
        $barang_id  = $brg[0]->barang_id;
        $stoktmp    = $brg[0]->qty;
        
        //menambah_stok stok
        $barang     = $this->db->get_where('produk', array('id' => $barang_id))->result();
        $stok       = $barang[0]->stok+$stoktmp;

        //proses update stok barang
        $data = array(
            'stok' => $stok
        );

        $where = array(
            'id' => $barang_id
        );
        $this->db->update('produk', $data, $where);
        
        //delete tmp
        $this->db->delete('tmp_trs', array('id' => $id)); 
    }

    function checkout()
    {
        //cek transaksi terakhir
        $this->db->select('id');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $cek    = $this->db->get()->result();
       
        if(empty($cek)){
            $kode = 1;
        }else{
            $kode   = $cek[0]->id+1;
        }
        $idlast = str_pad($kode, 3, '0', STR_PAD_LEFT);
        
        $user   = $_SESSION['id'];
        $tgl    = date('Y-m-d');
        $tanggal= date('Ymd');
        $kode   = "INV/$tanggal/$idlast";
        
        $data = array(
            'customer_id'    => $user,
            'tanggal'        => $tgl,
            'kode_transaksi' => $kode,
            'status'         => 'P'
        );
        $this->db->insert('transaksi', $data);
        $idnya = $this->db->insert_id();

        // insert detail
        $this->insertdatadetail($idnya);
        return $idnya;
    }

    function insertdatadetail($idnya)
    {
        $user   = $_SESSION['id'];

        $query = $this->db->query("INSERT transaksi_detail (transaksi_id, produk_id, jumlah)
                           SELECT '$idnya', barang_id, qty
                           FROM tmp_trs
                           WHERE user_id = $user");


        $this->db->delete('tmp_trs', array('user_id' => $user));
    }

    function showdetail($id)
    {
        return $this->db->get_where('transaksi', array('id' => $id))->result();
    }

    function showdetailproduk($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi_detail');
        $this->db->join('produk','produk.id = transaksi_detail.produk_id','left');
        $this->db->where('transaksi_id', $id);
        return $this->db->get()->result();
    }

}

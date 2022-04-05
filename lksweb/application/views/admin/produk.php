  <div class="container-fluid">

  	<!-- Page Heading -->
  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Data Produk
                          <a href="<?= base_url('Admin/add_produk');?>">
                                <button class="btn sm-btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button>
                          </a>
                        </h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  					<thead>
  						<th>No</th>
  						<th>Foto</th>
  						<th>Nama</th>
  						<th>Kategori</th>
  						<th>Deskripsi</th>
  						<th>Harga</th>
  						<th>Aksi</th>
  					</thead>
                                        <?php 
                                        $no = 1;
                                        foreach($produk as $pd):?>               
  					<tbody>
  						<td><?= $no; ?></td>
  						<td class="text-center"><img src="<?= base_url('template/img/produk/'). $pd->gambar; ?>" alt="" width="50px" height="50px"></td>
  						<td><?= $pd->nama_produk; ?></td>
  						<td><?= $pd->nama_kategori; ?></td>
  						<td><?= $pd->deskripsi; ?></td>
  						<td><?= "Rp. ".number_format($pd->harga); ?></td>
                                                <td>
                                                        <i class="fa fa-edit"></i> |
                                                        <i class="fa fa-trash"></i> 
                                                </td>
  					</tbody>
                                        <?php 
                                        $no++;
                                        endforeach; ?>
  				</table>
  			</div>
  		</div>
  	</div>

  </div>

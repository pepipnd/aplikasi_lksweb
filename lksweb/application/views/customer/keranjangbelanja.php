<div class="container-fluid">

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Keranjang Belanja</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<th>Aksi</th>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Foto</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Total</th>
					</thead>
					<?php 
                    $no = 1;
                    $grand =0;
                    foreach($keranjang as $krs): 
                    $total = $krs->qty*$krs->harga;
                    ?>
					<tbody>
						<td class="text-center">
							<a onClick="return confirm('Delete item ini?')" href='<?= base_url('Customer/delete_keranjang/').$krs->idtmp; ?>'
								type='button' >
								<i class="fa fa-trash text-danger "></i>
							</a>
						</td>
						<td><?= $no; ?></td>
						<td><?= $krs->nama_produk; ?></td>
						<td><img src="<?= base_url('template/img/produk/').$krs->gambar; ?>" alt="" width="100px"
								height="100px"></td>
						<td><?= $krs->qty; ?></td>
						<td><?= "Rp.".number_format($krs->harga); ?></td>
						<td class="text-right"><?= "Rp.".number_format($total); ?></td>
					</tbody>
					<?php 
                    $no++;
                    $grand += $total;
                    endforeach; 
                    if($keranjang):
                    ?>
					<tfoot>
						<td class="text-right" colspan="6"></td>
						<td class="text-right"><a href="<?= base_url('Customer/checkout')?>"><button class="btn btn-primary">Checkout</button></a> </td>
					</tfoot>
                    <?php 
                    endif;
                    ?>
					<tfoot>
						<td class="text-right" colspan="6">Grand Total</td>
						<td class="text-right">Rp.<?= number_format($grand);?></td>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

</div>

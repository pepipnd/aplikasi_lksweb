<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Invoice</h1>

	<!-- DataTales Example -->
	<div class="row">
		<div class="card shadow mb-4 col-md-6">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" width="100%" cellspacing="0">
						<tbody>
							<tr>
								<td>No Invoice</td>
								<td>:</td>
								<td><?= $invoice->kode_transaksi; ?></td>
							</tr>
							<tr>
								<td>Tanggal Transaksi</td>
								<td>:</td>
								<td><?= $invoice->tanggal; ?></td>
							</tr>
							<tr>
								<td>Status Transaksi</td>
								<td>:</td>
								<td>
                                <?php 
                                    $status = $invoice->status;
                                    if($status == 'Y'){
                                        echo "Selesai";
                                    }
                                    else if($status == 'Y'){
                                        echo "Gagal";
                                    }else{
                                        echo "Pending";
                                    }
                                ?>
                                </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="card shadow mb-4 col-md-12">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <?php 
                            $no=1;
                            $grand=0;
                            foreach($invoice_detail as $invd):
                            $total = $invd->jumlah*$invd->harga;
                        ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?= $invd->nama_produk;?></td>
                                <td><?= $invd->jumlah;?></td>
                                <td><?= "Rp. ".number_format($invd->harga);?></td>
                                <td><?=  "Rp. ".number_format($total) ?></td>
                            </tr>         
						</tbody>
                        <?php 
                            $grand += $total;
                            endforeach;
                        ?>   
                        <tfoot>
                            <tr>
                               <td class="text-right" colspan="4">Grand Total</td>
                               <td><?=  "Rp. ".number_format($grand); ?></td>
                            </tr>         
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

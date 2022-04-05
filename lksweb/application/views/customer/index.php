<!-- Topbar Search -->
<form method="POST" action="<?= base_url('Customer/search')?>" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
	<div class="input-group">
		<input type="text" name="search" class="form-control card-body shadow  border-1 small" placeholder="Cari Produk..." aria-label="Search"
			aria-describedby="basic-addon2">
		<div class="input-group-append">
			<input type="submit" value="Simpan" class="btn btn-primary">
		</div>
	</div>
</form>
<br><br>
<div class="container-fluid">
	<div class="row">
		<?php 
            foreach($produk as $prd):
        ?>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3  mb-4">
			<div class="card  shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2  text-center">
							<img src="<?= base_url('template/img/produk/').$prd->gambar?>" alt="" width="200px"
								height="200px">
						</div>
					</div>
				</div>
				<hr>
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								<?= $prd->nama_produk.' (Stok '.$prd->stok.')';?></div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= "Rp.".number_format($prd->harga); ?>
							</div>
						</div>
						<div class="col-auto">
							<a href="<?= base_url('Customer/add_chart/').$prd->id ?>">
								<i class="fas fa-shopping-cart fa-2x text-primary"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
                endforeach;
        ?>
	</div>
</div>

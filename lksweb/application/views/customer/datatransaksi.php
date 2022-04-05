<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no=1;
                        foreach($datatransaksi as $trs):

                        $status = $trs->status;
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $trs->kode_transaksi; ?></td>
                        <td><?= $trs->tanggal; ?></td>
                        <td>
                            <?php 
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
                        <td class='text-center'>
                            <a href="<?= base_url('Customer/show_detail/').$trs->id?>">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                        $no++;
                        endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
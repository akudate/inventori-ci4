<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Data Barang
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Barang</h5>
    </div>
    <div class="card-body">
    <?php 
        if (session()->getFlashdata("barang")) {
    ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('barang') ?>
    </div>
    <?php
        }
    ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-dark text-white text-center">
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <?php
                            if((session()->admin_role) == "admin"){
                        ?>
                        <th>Action</th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 0;
                    foreach ($rows as $row) {
                    $no++;
                ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td class="text-center">
                        <img src="<?= base_url('assets/gambar/'.$row->gambar) ?>" width="75px">
                    </td>
                    <td class="text-center"><?= $row->productID ?></td>
                    <td class="text-center"><?= $row->productName ?></td>
                    <td class="text-center"><?= $row->supplierID ?></td>
                    <td class="text-center">Rp<?= $row->harga ?></td>
                    <td class="text-center"><?= $row->stok ?></td>
                    <?php
                        if((session()->admin_role) == "admin"){
                    ?>
                    <td class="text-center">
                    <a href="<?= base_url('barang/'.$row->productID.'/edit') ?>" class="btn btn-success btn-sm"><i class="fas fa-fw fa-pencil"></i></a>
                    <a href="<?= base_url('barang/'.$row->productID.'/hapus') ?>" class="btn btn-danger btn-sm" 
                    onclick="return confirm('Yakin hapus <?= $row->productName ?>?')"><i class="fas fa-fw fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <?php
                if((session()->admin_role) == "admin"){
            ?>
            <a href="<?= base_url('tambah_barang') ?>" class="btn btn-primary btn-sm">Tambah</a>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Data Supplier
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Data Supplier</h5>
    </div>
    <div class="card-body">
    <?php 
        if (session()->getFlashdata("supplier")) {
    ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('supplier') ?>
    </div>
    <?php
        }
    ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-dark text-white text-center">
                        <th>No</th>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
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
                    <td class="text-center"><?= $row->supplierID ?></td>
                    <td class="text-center"><?= $row->supplierName ?></td>
                    <td class="text-center"><?= nl2br($row->alamat) ?></td>
                    <td class="text-center"><?= $row->telepon ?></td>
                    

                    <!-- Hanya bisa diakses oleh admin -->
                    <?php
                        if((session()->admin_role) == "admin"){
                    ?>
                    <td class="text-center">
                    <a href="<?= base_url('supplier/'.$row->supplierID.'/edit') ?>" class="btn btn-success btn-sm"><i class="fas fa-fw fa-pencil"></i></a>
                    <a href="<?= base_url('supplier/'.$row->supplierID.'/hapus') ?>" class="btn btn-danger btn-sm" 
                    onclick="return confirm('Yakin hapus <?= $row->supplierName ?>?')"><i class="fas fa-fw fa-trash"></i></a>
                    </td>
                </tr>
                    <?php
                        }
                    }
                    ?>
                    <!-- Pembatas -->


                </tbody>
            </table>
            <?php
                if((session()->admin_role) == "admin"){
            ?>
            <a href="<?= base_url('tambah_supplier') ?>" class="btn btn-primary btn-sm">Tambah</a>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
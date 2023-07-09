<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Tambah Barang Masuk
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk</h5>
    </div>
    <div class="card-body">
    <?php 
        if (session()->getFlashdata("pesan")) {
    ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('pesan') ?>
    </div>
    <?php
        }
    ?>
    <form method="post" action="<?= base_url('proses_tambah_barangmasuk') ?>" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Transaction ID</label>
            <input type="text" name="transactionID" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Product</label>
            <select class="form-select" name="productID">
                    <?php
                    foreach($rows as $row){
                    ?>
                    <option value="<?= $row->productID ?>">
                        <?= $row->productName ?>
                    </option>
                    <?php
                    }
                    ?>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Jumlah Masuk</label>
            <input type="number" name="jumlah_masuk" class="form-control" required>
        </div><br>
        <div class="mb-2">
            <a href="<?= base_url('data_barangmasuk') ?>" class="btn btn-primary btn-sm mr-3">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
        </div>
    </form>
    </div>
</div>
<?= $this->endSection() ?>
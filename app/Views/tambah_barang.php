<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Tambah Barang
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Tambah Barang</h5>
    </div>
    <div class="card-body">
    <form method="post" action="<?= base_url('proses_tambah_barang') ?>" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Product ID</label>
            <input type="text" name="productID" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Product Name</label>
            <input type="text" name="productName" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Supplier</label>
            <select class="form-select" name="supplierID">
                    <?php
                    foreach($rows as $row){
                    ?>
                    <option value="<?= $row->supplierID ?>">
                        <?= $row->supplierName ?>
                    </option>
                    <?php
                    }
                    ?>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="0" readonly required>
        </div><br>
        <div class="mb-2">
            <a href="<?= base_url('data_barang') ?>" class="btn btn-primary btn-sm mr-3">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
        </div>
    </form>
    </div>
</div>
<?= $this->endSection() ?>
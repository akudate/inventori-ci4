<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Edit Supplier
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Edit Supplier</h5>
    </div>
    <div class="card-body">
    <form method="post" action="<?= base_url('proses_edit_supplier') ?>" enctype="multipart/form-data">
    <div class="mb-2">
        <label class="form-label">Supplier ID</label>
        <input type="text" name="supplierID" class="form-control" value="<?= $supplier->supplierID ?>" readonly required>
    </div>
    <div class="mb-2">
        <label class="form-label">Supplier Name</label>
        <input type="text" name="supplierName" class="form-control" value="<?= $supplier->supplierName ?>" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat" required><?= $supplier->alamat ?></textarea>
    </div>
    <div class="mb-2">
        <label class="form-label">Telepon</label>
        <input type="text" class="form-control" name="telepon" value="<?= $supplier->telepon ?>" required>
    </div><br>
    <div class="mb-2">
        <a href="<?= base_url('data_supplier') ?>" class="btn btn-primary btn-sm mr-3">Kembali</a>
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
    </div>
</form>
    </div>
</div>
<?= $this->endSection() ?>
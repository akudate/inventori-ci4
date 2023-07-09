<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Edit Barang Keluar
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Edit Barang Keluar</h5>
    </div>
    <div class="card-body">
    <form method="post" action="<?= base_url('proses_edit_barangkeluar') ?>" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Transaction ID</label>
            <input type="text" name="transactionID" class="form-control" value="<?= $barang_keluar->transactionID ?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= $barang_keluar->tanggal ?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Product</label>
            <select class="form-select" name="productID">
                    <?php
                    foreach($rows as $row){
                        if($row->productID == $barang_keluar->productID){
                            $ses = "selected";
                        }else{
                            $ses = "";
                        }
                    ?>
                    <option value="<?= $row->productID ?>" <?= $ses ?>>
                        <?= $row->productName ?>
                    </option>
                    <?php
                    }
                    ?>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Jumlah Keluar</label>
            <input type="number" name="jumlah_keluar" class="form-control" value="<?= $barang_keluar->jumlah_keluar ?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="<?= $barang_keluar->tujuan ?>" required>
        </div><br>
        <div class="mb-2">
            <a href="<?= base_url('data_barangkeluar') ?>" class="btn btn-primary btn-sm mr-3">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
        </div>
    </form>
    </div>
</div>
<?= $this->endSection() ?>
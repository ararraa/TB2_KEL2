

<!-- views/produk/edit.php -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <?= form_open('produk/edit/' . $produk->no_item); ?>
                <div class="form-group">
                    <label for="no_item">No Item</label>
                    <input type="text" class="form-control" id="no_item" name="no_item" value="<?= $produk->no_item; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= set_value('nama_barang', $produk->nama_barang); ?>">
                    <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>
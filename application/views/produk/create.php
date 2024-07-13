
<!-- views/produk/create.php -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <?= form_open('produk/create'); ?>
                <div class="form-group">
                    <label for="no_item">No Item</label>
                    <input type="text" class="form-control" id="no_item" name="no_item" value="<?= set_value('no_item'); ?>">
                    <?= form_error('no_item', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= set_value('nama_barang'); ?>">
                    <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>
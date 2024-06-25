<!-- application/views/produk/edit.php -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Produk</h1>

    <!-- Form Edit Produk -->
    <div class="card shadow mb-4">
        <div class="card-body">
<<<<<<< HEAD
        <form action="<?= base_url('produk/update'); ?>" method="POST">
    <input type="hidden" name="no_item" value="<?= $produk->no_item ?>">
    <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $produk->nama_barang ?>" required>
        <label for="nama_barang">Qty</label>
        <input type="text" class="form-control" id="qty" name="qty" value="<?= $produk->qty ?>" required>
=======
            <form action="<?= base_url('produk/update'); ?>" method="POST">
                <input type="hidden" name="no_item" value="<?= $produk->no_item ?>">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $produk->nama_barang ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="<?= $produk->qty ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
>>>>>>> ecd8e536eb55b510d0b133fe2602af2a08b1f25f
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


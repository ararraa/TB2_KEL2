
<!-- views/produk/index.php -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Produk</h1>
    <p class="mb-4">Berikut adalah daftar produk yang tersedia.</p>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Item</th>
                            <th>Nama Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $prod) : ?>
                            <tr>
                                <td><?= $prod->no_item; ?></td>
                                <td><?= $prod->nama_barang; ?></td>
                                <td>
                                    <a href="<?= base_url('produk/edit/' . $prod->no_item); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                                    <a href="<?= base_url('produk/delete/' . $prod->no_item); ?>" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <a href="<?= base_url('produk/create'); ?>" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>
</div>
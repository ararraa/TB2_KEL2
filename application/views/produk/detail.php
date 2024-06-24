<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
</head>

<body>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Detail Produk</h1>
                <p class="mb-4">Detail dari produk yang dipilih.</p>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?= base_url('assets/img/products/') . $produk->image; ?>" class="img-fluid" alt="<?= $produk->nama_barang; ?>">
                            </div>
                            <div class="col-lg-8">
                                <h3><?= $produk->nama_barang; ?></h3>
                                <p>No Item: <?= $produk->id; ?></p>
                                <p>Harga: Rp <?= number_format($produk->harga, 0, ',', '.'); ?></p>
                                <a href="<?= base_url('produk'); ?>" class="btn btn-primary">Kembali ke Daftar Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Tambahkan script lainnya jika diperlukan
        });
    </script>
</body>

</html>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Flashdata Message -->
    <?= $this->session->flashdata('message'); ?>

    <!-- Filter Form -->
    <form action="<?= base_url('inventory/stock_report'); ?>" method="get">
        <div class="form-group">
            <label for="filter_item">Filter Berdasarkan Nama Item:</label>
            <select class="form-control" id="filter_item" name="filter_item">
                <option value="">Semua</option>
                <!-- Loop untuk menampilkan pilihan nama item dari database -->
                <?php foreach ($products as $product) : ?>
                    <option value="<?= $product['nama_item']; ?>"><?= $product['nama_item']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Tabel Laporan Stock -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Invoice</th>
                        <th scope="col">Nama Item</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Detail Pengirim/Penerima</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($stock_reports)) : ?>
                        <?php foreach ($stock_reports as $index => $report) : ?>
                            <tr>
                                <th scope="row"><?= $index + 1; ?></th>
                                <td><?= $report['no_invoice']; ?></td>
                                <td><?= $report['no_item']; ?></td>
                                <td><?= $report['barang_masuk']; ?></td>
                                <td><?= $report['detail_pengirim_penerima']; ?></td>
                                <td><?= $report['tanggal']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

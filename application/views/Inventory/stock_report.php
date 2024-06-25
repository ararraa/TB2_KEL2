<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row mb-4">
        <div class="col-lg-12">
            <form method="GET" action="<?= base_url('inventory/stock_report'); ?>">
                <div class="form-group">
                    <label for="filter_item">Filter by Item</label>
                    <select name="filter_item" id="filter_item" class="form-control">
                        <option value="">Select Item</option>
                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product->no_item; ?>" <?= ($this->input->get('filter_item') == $product->no_item) ? 'selected' : ''; ?>>
                                <?= $product->nama_barang; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Laporan Persediaan Stock</th>
                        <th scope="col">No Item</th>
                        <th scope="col">No Invoice</th>
                        <th scope="col">No Penjualan</th>
                        <th scope="col">Detail Pengirim/Penerima</th>
                        <th scope="col">Barang Masuk</th>
                        <th scope="col">Barang Keluar</th>
                        <th scope="col">Stock Akhir</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($stock_reports)) : ?>
                        <?php $i = 1; ?>
                        <?php foreach ($stock_reports as $report) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $report['no_laporan_persediaan_stock']; ?></td>
                                <td><?= $report['no_item']; ?></td>
                                <td><?= $report['no_invoice']; ?></td>
                                <td><?= $report['no_penjualan']; ?></td>
                                <td><?= $report['detail_pengirim_penerima']; ?></td>
                                <td><?= $report['barang_masuk']; ?></td>
                                <td><?= $report['barang_keluar']; ?></td>
                                <td><?= $report['stock_akhir']; ?></td>
                                <td><?= $report['created_at']; ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
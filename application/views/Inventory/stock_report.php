<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <div class="row">
        <div class="col-lg-12">
            <form action="<?= base_url('inventory/stock_report'); ?>" method="post">
            <div class="form-group">
    <label for="nama_barang">Nama Barang</label>
    <select class="form-control" id="nama_barang" name="nama_barang">
        <option value="">Pilih Barang</option>
        <?php foreach ($produk as $prod) : ?>
            <option value="<?= $prod->nama_barang; ?>"><?= $prod->nama_barang; ?></option>
        <?php endforeach; ?>
    </select>
</div>

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <div class="table-responsive mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Barang</th>
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
                                    <td><?= $report['nama_barang']; ?></td>
                                    <td><?= $report['no_laporan_persediaan_stock']; ?></td>
                                    <td><?= $report['no_item']; ?></td>
                                    <td><?= $report['no_invoice']; ?></td>
                                    <td><?= $report['no_penjualan']; ?></td>
                                    <td><?= $report['detail_pengirim_penerima']; ?></td>
                                    <td><?= $report['barang_masuk']; ?></td>
                                    <td><?= $report['barang_keluar']; ?></td>
                                    <td><?= $report['stock_akhir']; ?></td>
                                    <td><?= $report['tanggal']; ?></td> <!-- Assuming 'created_at' is mapped to 'tanggal' -->
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="11" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

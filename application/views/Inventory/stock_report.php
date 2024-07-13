<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mb-3">
        <div class="col-lg-4">
            <form method="GET" action="">
                <div class="form-group">
                    <label for="filterProduct">Filter Nama Produk</label>
                    <select class="form-control" id="filterProduct" name="filterProduct">
                        <option value="">Semua Produk</option>
                        <?php foreach ($requested_products as $product) : ?>
                            <option value="<?= $product['Nama_Barang']; ?>" <?= isset($_GET['filterProduct']) && $_GET['filterProduct'] == $product['Nama_Barang'] ? 'selected' : ''; ?>>
                                <?= $product['Nama_Barang']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No Invoice</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $filtered_reports = [];
                        $total_qty = 0;
                        if (!empty($stock_reports)) {
                            if (isset($_GET['filterProduct']) && $_GET['filterProduct'] !== '') {
                                foreach ($stock_reports as $report) {
                                    if ($report['Nama_Barang'] === $_GET['filterProduct']) {
                                        $filtered_reports[] = $report;
                                        $total_qty += isset($report['Qty']) ? $report['Qty'] : 0;
                                    }
                                }
                            } else {
                                $filtered_reports = $stock_reports;
                                foreach ($stock_reports as $report) {
                                    $total_qty += isset($report['Qty']) ? $report['Qty'] : 0;
                                }
                            }
                        }
                        ?>
                        <?php if (!empty($filtered_reports)) : ?>
                            <?php foreach ($filtered_reports as $report) : ?>
                                <tr>
                                    <td><?= isset($report['no_invoice']) ? $report['no_invoice'] : ''; ?></td>
                                    <td><?= isset($report['Nama_Barang']) ? $report['Nama_Barang'] : ''; ?></td>
                                    <td><?= isset($report['Qty']) ? $report['Qty'] : ''; ?></td>
                                    <td>
                                        <?php if (isset($report['status']) && $report['status'] == 'in') : ?>
                                            <button class="btn btn-success">in</button>
                                        <?php elseif (isset($report['status']) && $report['status'] == 'out') : ?>
                                            <button class="btn btn-danger">out</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="mt-3">
                    <h5>Total Quantity: <?= $total_qty; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

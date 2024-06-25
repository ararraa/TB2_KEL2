<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

            <!-- Form Penerimaan -->
            <form id="receiveForm" action="<?= base_url('inventory/receive'); ?>" method="post">
                <div class="form-group">
                    <label for="no_invoice">No Invoice</label>
                    <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="<?= set_value('no_invoice'); ?>">
                </div>
                <div class="form-group">
                    <label for="no_request_product">No Request Product</label>
                    <input type="text" class="form-control" id="no_request_product" name="no_request_product" value="<?= set_value('no_request_product'); ?>">
                </div>
                <div class="form-group">
                    <label for="detail_pengirim">Detail Pengirim</label>
                    <input type="text" class="form-control" id="detail_pengirim" name="detail_pengirim" value="<?= set_value('detail_pengirim'); ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal'); ?>">
                </div>

                <!-- Tabel Penerimaan -->
                <table class="table table-hover mt-4" id="receiveTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Invoice Obat Detail</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                            <th scope="col"><button type="button" class="btn btn-primary" id="addRow">+</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><input type="text" name="id_invoice_obat_detail[]" class="form-control"></td>
                            <td><input type="text" name="nama_barang[]" class="form-control"></td>
                            <td><input type="number" name="qty[]" class="form-control qty"></td>
                            <td><input type="number" name="harga[]" class="form-control harga"></td>
                            <td><input type="number" name="total[]" class="form-control total" readonly></td>
                            <td><button type="button" class="btn btn-danger removeRow">-</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Tambahkan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk menghitung total
        function calculateTotal() {
            $('#receiveTable tbody tr').each(function() {
                var qty = $(this).find('.qty').val();
                var harga = $(this).find('.harga').val();
                var total = qty * harga;
                $(this).find('.total').val(total);
            });
        }

        // Hitung total ketika qty atau harga berubah
        $('#receiveTable').on('input', '.qty, .harga', function() {
            calculateTotal();
        });

        // Tambah baris baru
        $('#addRow').click(function() {
            var newRow = `<tr>
                            <th scope="row">` + ($('#receiveTable tbody tr').length + 1) + `</th>
                            <td><input type="text" name="id_invoice_obat_detail[]" class="form-control"></td>
                            <td><input type="text" name="nama_barang[]" class="form-control"></td>
                            <td><input type="number" name="qty[]" class="form-control qty"></td>
                            <td><input type="number" name="harga[]" class="form-control harga"></td>
                            <td><input type="number" name="total[]" class="form-control total" readonly></td>
                            <td><button type="button" class="btn btn-danger removeRow">-</button></td>
                        </tr>`;
            $('#receiveTable tbody').append(newRow);
        });

        // Hapus baris
        $('#receiveTable').on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
            // Perbarui nomor urut setelah menghapus baris
            $('#receiveTable tbody tr').each(function(index) {
                $(this).find('th').text(index + 1);
            });
            calculateTotal();
        });

        // Hitung total saat halaman dimuat
        calculateTotal();
    });
</script>

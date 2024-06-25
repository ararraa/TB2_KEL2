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
<<<<<<< HEAD
                            <th scope="col">Nama Barang</th>
=======
                            <th scope="col">Nama Barang</th> <!-- Ubah label disini -->
>>>>>>> ecd8e536eb55b510d0b133fe2602af2a08b1f25f
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
<<<<<<< HEAD
                            <td><input type="text" name="nama_barang[]" class="form-control"></td>
=======
                            <td><input type="text" name="nama_barang[]" class="form-control"></td> <!-- Ubah name disini -->
>>>>>>> ecd8e536eb55b510d0b133fe2602af2a08b1f25f
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let receiveTable = document.getElementById('receiveTable').getElementsByTagName('tbody')[0];
        document.getElementById('addRow').addEventListener('click', function () {
            let rowCount = receiveTable.rows.length;
            let row = receiveTable.insertRow(rowCount);
            row.innerHTML = `
                <th scope="row">${rowCount + 1}</th>
                <td><input type="text" name="id_invoice_obat_detail[]" class="form-control"></td>
<<<<<<< HEAD
                <td><input type="text" name="nama_barang[]" class="form-control"></td>
=======
                <td><input type="text" name="nama_barang[]" class="form-control"></td> <!-- Ubah name disini -->
>>>>>>> ecd8e536eb55b510d0b133fe2602af2a08b1f25f
                <td><input type="number" name="qty[]" class="form-control qty"></td>
                <td><input type="number" name="harga[]" class="form-control harga"></td>
                <td><input type="number" name="total[]" class="form-control total" readonly></td>
                <td><button type="button" class="btn btn-danger removeRow">-</button></td>
            `;

            row.querySelector('.removeRow').addEventListener('click', function () {
                this.closest('tr').remove();
                updateRowNumbers();
            });

            row.querySelector('.qty').addEventListener('input', calculateTotal);
            row.querySelector('.harga').addEventListener('input', calculateTotal);
        });

        function updateRowNumbers() {
            let rows = receiveTable.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                rows[i].getElementsByTagName('th')[0].innerText = i + 1;
            }
        }

        function calculateTotal() {
            let row = this.closest('tr');
            let qty = row.querySelector('.qty').value;
            let harga = row.querySelector('.harga').value;
            row.querySelector('.total').value = qty * harga;
        }

        let existingRows = receiveTable.getElementsByTagName('tr');
        for (let row of existingRows) {
            row.querySelector('.removeRow').addEventListener('click', function () {
                this.closest('tr').remove();
                updateRowNumbers();
            });

            row.querySelector('.qty').addEventListener('input', calculateTotal);
            row.querySelector('.harga').addEventListener('input', calculateTotal);
        }

        // Menambahkan event listener pada form submit
        document.getElementById('receiveForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form submit secara default
            alert("Barang Diterima"); // Alert ini bisa dihapus atau dimodifikasi sesuai kebutuhan
            this.submit(); // Melanjutkan submit form
        });
    });
</script>

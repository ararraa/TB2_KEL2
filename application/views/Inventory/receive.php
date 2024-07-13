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
            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Form Penerimaan -->
            <form action="<?= base_url('inventory/receive'); ?>" method="post">
                <div class="form-group">
                    <label for="no_invoice">No Invoice</label>
                    <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="<?= set_value('no_invoice'); ?>">
                    <?= form_error('no_invoice', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="id_request">ID Request</label>
                    <select class="form-control" id="id_request" name="id_request">
                        <option value="">Pilih ID Request</option>
                        <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $request): ?>
                                <option value="<?= $request['ID_Request']; ?>" <?= set_select('id_request', $request['ID_Request']); ?>>
                                    <?= $request['ID_Request']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?= form_error('id_request', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="button" class="btn btn-info" onclick="fetchRequestDetails()">Pilih</button>
                <div class="form-group">
                    <label for="detail_pengirim">Detail Pengirim</label>
                    <input type="text" class="form-control" id="detail_pengirim" name="detail_pengirim" value="<?= set_value('detail_pengirim'); ?>">
                    <?= form_error('detail_pengirim', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal'); ?>">
                    <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                </div>

                <!-- Tabel Penerimaan -->
                <table class="table table-hover mt-4" id="receiveTable">
                    <thead>
                        <tr>
                            <th scope="col">ID Request Detail</th>
                            <th scope="col">No Item</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody id="receiveTableBody">
                        <!-- Rows will be inserted here dynamically -->
                    </tbody>
                </table>

                <!-- Input hidden untuk menyimpan data tabel -->
                <input type="hidden" id="tableDataInput" name="tableData">

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to handle fetching request details
    function fetchRequestDetails() {
        var id_request = $('#id_request').val();
        if (id_request) {
            $.ajax({
                url: '<?= base_url("inventory/get_request_details/"); ?>' + id_request,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tableBody = $('#receiveTableBody');
                    tableBody.empty();
                    $.each(data, function(index, detail) {
                        tableBody.append('<tr><td>' + detail.ID_Request_Detail + '</td><td>' + detail.No_Item + '</td><td>' + detail.Nama_Barang + '</td><td>' + detail.Qty + '</td></tr>');
                    });
                }
            });
        } else {
            $('#receiveTableBody').empty();
        }
    }

    // Function to handle form submission
    $(document).ready(function() {
        $('form').submit(function() {
            // Ambil nilai dari tabel penerimaan
            var tableData = [];
            $('#receiveTableBody tr').each(function(row, tr) {
                var rowData = {
                    'id_request_detail': $(tr).find('td:eq(0)').text(), // Kolom ke-1 (indeks 0) berisi ID Request Detail
                    'no_item': $(tr).find('td:eq(1)').text(), // Kolom ke-2 (indeks 1) berisi No Item
                    'nama_barang': $(tr).find('td:eq(2)').text(), // Kolom ke-3 (indeks 2) berisi Nama Barang
                    'qty': $(tr).find('td:eq(3)').text() // Kolom ke-4 (indeks 3) berisi Qty
                };
                tableData.push(rowData);
            });

            // Masukkan nilai ke input hidden sebelum submit
            $('#tableDataInput').val(JSON.stringify(tableData));
        });
    });
</script>
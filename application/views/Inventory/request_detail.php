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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID Request</th>
                        <th scope="col">No Item</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($request_details) && !empty($request_details)) : ?>
                        <?php foreach ($request_details as $detail) : ?>
                            <tr>
                                <td><?= $detail['ID_Request']; ?></td>
                                <td><?= $detail['No_Item']; ?></td>
                                <td><?= $detail['Qty']; ?></td>
                                <td><?= $detail['Harga']; ?></td>
                                <td><?= $detail['Total_Harga']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" align="right"><strong>Total Keseluruhan</strong></td>
                            <td><?= $request['Jumlah_Harga']; ?></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No request details found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-4">
                <a href="<?= base_url('inventory/request-form'); ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

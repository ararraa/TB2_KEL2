<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?php if (!empty(validation_errors())) : ?>
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
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($request_details)) : ?>
                        <?php foreach ($request_details as $detail) : ?>
                            <tr>
                                <td><?= $detail['ID_Request']; ?></td>
                                <td><?= $detail['No_Item']; ?></td>
                                <td><?= $detail['Nama_Barang']; ?></td>
                                <td><?= $detail['Qty']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3">No request details found.</td>
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

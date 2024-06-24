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
                        <th scope="col">Id</th>
                        <th scope="col">No Request</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($requests) && !empty($requests)) : ?>
                        <?php $i = 1; ?>
                        <?php foreach ($requests as $request) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $request['No_Request_Detail']; ?></td>
                                <td><?= $request['Username']; ?></td> <!-- Updated line -->
                                <td><?= $request['Tanggal']; ?></td>
                                <td><?= $request['Jumlah_Harga']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detail/') . $request['ID_Request']; ?>" class="badge badge-info">detail</a>
                                    <a href="<?= base_url('admin/continue/') . $request['ID_Request']; ?>" class="badge badge-primary">continue</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">No form requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
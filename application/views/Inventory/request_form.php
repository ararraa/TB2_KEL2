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
            
            <!-- Existing requests table -->
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">No Request</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($requests)) : ?>
                        <?php foreach ($requests as $request) : ?>
                            <tr>
                                <th scope="row"><?= $request['ID_Request']; ?></th>
                                <td><?= $request['No_Request_Detail']; ?></td>
                                <td><?= $request['name']; ?></td>
                                <td><?= $request['Tanggal']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detail/') . $request['ID_Request']; ?>" class="badge badge-info">detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No form requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

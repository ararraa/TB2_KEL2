<!-- Display Flash Messages -->
<?php if ($this->session->flashdata('success_message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success_message'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

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
            <?php foreach ($requests as $request) : ?>
                <tr>
                    <th scope="row"><?= $request['ID_Request']; ?></th>
                    <td><?= $request['No_Request_Detail']; ?></td>
                    <td><?= $request['Username']; ?></td>
                    <td><?= $request['Tanggal']; ?></td>
                    <td><?= $request['Jumlah_Harga']; ?></td>
                    <td>
                        <a href="<?= base_url('user/continueRequest/') . $request['ID_Request']; ?>" class="badge badge-info">detail</a>
                        <?php if ($this->session->userdata('role_id') == 1): // Check if admin ?>
                            <a href="<?= base_url('admin/continueRequest/') . $request['ID_Request']; ?>" class="badge badge-primary continue-request" onclick="return confirm('Are you sure you want to continue this request?')">continue</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">No form requests found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

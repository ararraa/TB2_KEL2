request form : 
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
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($requests) && !empty($requests)) : ?>
                        <?php $i = 1; ?>
                        <?php foreach ($requests as $request) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $request['title']; ?></td>
                                <td><?= $request['menu']; ?></td>
                                <td><?= $request['url']; ?></td>
                                <td><?= $request['icon']; ?></td>
                                <td><?= $request['is_active']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detail/') . $request['id']; ?>" class="badge badge-info">detail</a>
                                    <a href="<?= base_url('admin/continue/') . $request['id']; ?>" class="badge badge-primary">continue</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">No form requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
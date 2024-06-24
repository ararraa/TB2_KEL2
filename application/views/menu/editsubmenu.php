<!-- Begin Page content-->
<div class="container-fluid">  

<!-- Page Heading-->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?> ( Edit )</h1>

        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>

        <form action="<?= base_url('menu/updateSubMenu/'. $menu['id']); ?>" method="post">
            <div class="form-group">
                <h6>Sub Menu ID</h6>
                <input type="text" class="form-control" id="submenuid" name="submenuid"
                placeholder="Submenu ID" value="<?= $submenu['id'] ?>" disabled>
                </div>

                <div class="form-group">
                <h6>Menu</h6>
                <select name="menu_id" id="menu_id" class="form-control">
                    <option value="">Select Menu</option>
                    <?php foreach ($menu as $m) : ?>
                        <?php if ($subMenu['menu_id'] = $m['id']) : ?>
                            <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                        <?php else : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
               </select>
            </div>

            <div class="form-group">
                <h6>Sub Menu URL</h6>
                <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $submenu['url']; ?>" >
            </div>
            <div class="form-group">
                <h6>Sub Menu Icon</h6>
                <input type="text" class="form-control" id="icon" name="icon"  value="<?= $submenu['icon']; ?>">
            </div>

            <div class="form-group">
                <div class="form-cheeck">
            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
            <label class="form-check-label" for="is_active">
                                Active?
                            </label> 
            </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit Edit</button>
            <a href="<?= base_url('menu')?>" class="btn btn-secondary" data-dismiss="modal">Back</a>
            </form>
            </div>
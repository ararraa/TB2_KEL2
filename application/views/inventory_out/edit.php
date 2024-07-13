<!DOCTYPE html>
<html>
<head>
    <title>Edit Inventory Out</title>
</head>
<body>
    <h1>Edit Inventory Out</h1>
    <form action="<?php echo site_url('inventory_out/update/'.$inventory_out->id); ?>" method="post">
        <label>Item No</label>
        <input type="text" name="item_no" value="<?php echo $inventory_out->item_no; ?>"><br>
        <label>Quantity</label>
        <input type="number" name="qty" value="<?php echo $inventory_out->qty; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
